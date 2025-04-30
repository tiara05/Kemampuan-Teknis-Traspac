<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\AfterSheet;

class PegawaiExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * Mendapatkan seluruh data pegawai
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data pegawai beserta relasinya
        return Pegawai::with(['unitKerja', 'eselon', 'golongan'])->get()->map(function ($pegawai, $index) {
            return [
                'no' => $index + 1,  // Menampilkan ID sebagai No
                'nip' => $pegawai->nip,
                'nama' => $pegawai->nama,
                'tempat_lahir' => $pegawai->tempat_lahir,
                'alamat' => $pegawai->alamat,
                'tgl_lahir' => $pegawai->tgl_lahir,
                'jenis_kelamin' => $pegawai->jenis_kelamin,
                'golongan' => $pegawai->golongan ? $pegawai->golongan->name : null, // Ambil nama golongan jika ada
                'eselon' => $pegawai->eselon ? $pegawai->eselon->name : null, // Ambil nama eselon jika ada
                'jabatan' => $pegawai->jabatan,
                'tempat_tugas' => $pegawai->tempat_tugas,
                'agama' => $pegawai->agama,
                'unit_kerja' => $pegawai->unit ? $pegawai->unit->name : null, // Ambil nama unit jika ada
                'no_hp' => $pegawai->no_hp,
                'npwp' => $pegawai->npwp,
            ];
        });
    }

    /**
     * Menentukan heading untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'NIP',
            'Nama',
            'Tempat Lahir',
            'Alamat',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Golongan',
            'Eselon',
            'Jabatan',
            'Tempat Tugas',
            'Agama',
            'Unit Kerja',
            'No HP',
            'NPWP',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                $columns = range('A', 'O');
                $maxWidths = [];

                foreach ($columns as $columnIndex) {
                    $maxWidths[$columnIndex] = 0;

                    foreach ($sheet->getRowIterator() as $row) {
                        $cell = $sheet->getCell($columnIndex . $row->getRowIndex());
                        $maxWidths[$columnIndex] = max($maxWidths[$columnIndex], strlen($cell->getValue()));
                    }

                    $sheet->getColumnDimension($columnIndex)->setWidth($maxWidths[$columnIndex] + 2); 
                }
            },
        ];
    }
}
