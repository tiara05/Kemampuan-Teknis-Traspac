<?php

namespace App\Repositories;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiRepo
{
    public function getAll()
    {
        return Pegawai::with(['golongan', 'unitKerja', 'eselon'])->paginate(10);
    }

    public function store(array $data)
    {
        return Pegawai::create($data);
    }

    public function update(Pegawai $pegawai, array $data)
    {
        return $pegawai->update($data);
    }

    public function destroy($id)
    {
        return Pegawai::findOrFail($id)->delete();
    }

    public function getAllFiltered(Request $request)
    {
        $query = Pegawai::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('nip', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%")
                ->orWhere('tempat_tugas', 'like', "%{$search}%");
            });
        }

        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->input('unit_id'));
        }

        if ($request->order == 'latest') {
            $query->latest(); 
        } elseif ($request->order == 'oldest') {
            $query->oldest(); 
        } else {
            $query->orderBy('nama', 'asc');
        }

        return $query->paginate(10)->withQueryString(); // atau ->get() jika tidak ingin pagination
    }


    public function filterByUnit($unit_id)
    {
        return Pegawai::where('unit_id', $unit_id)->get();
    }
}
