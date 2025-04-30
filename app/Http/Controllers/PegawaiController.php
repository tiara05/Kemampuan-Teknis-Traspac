<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\Golongan;
use App\Models\Eselon;
use App\Repositories\PegawaiRepo;
use Illuminate\Http\Request;
use PDF;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class PegawaiController extends Controller
{
    protected $pegawaiRepo;

    public function __construct(PegawaiRepo $pegawaiRepo)
    {
        $this->pegawaiRepo = $pegawaiRepo;
    }

    public function index(Request $request)
    {
        $data['units'] = Unit::all();
        $data['pegawai'] = $this->pegawaiRepo->getAllFiltered($request);
        return view('dashboard.pegawai.index', $data);
    }


    public function create()
    {
        $unit = Unit::all();
        $golongan = Golongan::all();
        $eselon = Eselon::all();

        return view('dashboard.pegawai.render.create', compact('unit','golongan', 'eselon'));
    }

    public function store(Request $request)
    {
        Log::info('Menerima request untuk menambahkan pegawai', $request->all());
        $request->validate([
            'nip' => 'required|unique:pegawais,nip',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_id' => 'required|exists:golongans,id',
            'eselon_id' => 'required|exists:eselons,id',
            'jabatan' => 'required|string|max:255',
            'tempat_tugas' => 'required|string|max:255',
            'agama' => 'required|in:Islam,Kristen,Hindu,Buddha,Katholik,Konghucu',
            'unit_id' => 'required|exists:units,id',
            'no_hp' => 'required|string|max:20',
            'npwp' => 'required|string|max:30',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Jika ada foto di-upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto_pegawai', $filename);
            $data['foto'] = $filename;
        }

        // Simpan data ke repository
        $this->pegawaiRepo->store($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function show(Pegawai $pegawai)
    {
        $pegawai->load(['golongan', 'eselon', 'unitKerja']);
        return view('dashboard.pegawai.render.detail', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        $unit = Unit::all();
        $golongan = Golongan::all();
        $eselon = Eselon::all();
        
        return view('dashboard.pegawai.render.edit', compact('pegawai', 'unit','golongan', 'eselon'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|unique:pegawais,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_id' => 'required|exists:golongans,id',
            'eselon_id' => 'required|exists:eselons,id',
            'jabatan' => 'required|string|max:255',
            'tempat_tugas' => 'required|string|max:255',
            'agama' => 'required|in:Islam,Kristen,Hindu,Buddha,Katholik,Konghucu',
            'unit_id' => 'required|exists:units,id',
            'no_hp' => 'required|string|max:20',
            'npwp' => 'required|string|max:30',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Jika ada foto di-upload, simpan foto baru dan hapus foto lama
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto) {
                Storage::delete('public/foto_pegawai/' . $pegawai->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto_pegawai', $filename);
            $data['foto'] = $filename;
        }

        // Update data pegawai menggunakan repository
        $this->pegawaiRepo->update($pegawai, $data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui!');
    }

    public function delete(Pegawai $pegawai)
    {
        $data['pegawai'] = $pegawai;
        $data['route'] = route('pegawai.destroy', $pegawai->id);
        // Merender tampilan konfirmasi delete
        return view('common-render.confirm-delete', $data);
    }

    public function destroy($id)
    {
        try {
            $this->pegawaiRepo->destroy($id);
        
            return redirect()->route('pegawai.index')->with('success', 'Informasi berhasil dihapus!');
        } catch (\Throwable $th) {
            Log::error('Gagal menghapus pegawai: ' . $th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);
        
            return redirect()->route('pegawai.index')->with('error', 'Gagal menghapus pegawai: ' . $th->getMessage());
        }
    }

    public function cetakPdf(Request $request)
    {
        $pegawais = $this->pegawaiRepo->getAllFiltered($request, false); // false untuk tanpa paginate
    
        $pdf = PDF::loadView('dashboard.pegawai.cetak-pdf', [
            'pegawais' => $pegawais,
            'unit' => $request->unit_id ? Unit::find($request->unit_id)?->name : 'Semua Unit',
        ])->setPaper('A4', 'landscape');;
    
        return $pdf->stream('daftar_pegawai.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new PegawaiExport, 'daftar_pegawai.xlsx');
    }
}
