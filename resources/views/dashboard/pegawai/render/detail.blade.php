<div class="table-responsive">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="text-nowrap">NIP</td>
                <td class="text-nowrap">{{ $pegawai->nip }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Nama</td>
                <td class="text-nowrap">{{ $pegawai->nama }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Tempat Lahir</td>
                <td class="text-nowrap">{{ $pegawai->tempat_lahir ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Tanggal Lahir</td>
                <td class="text-nowrap">{{ $pegawai->tanggal_lahir ? \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Jenis Kelamin</td>
                <td class="text-nowrap">{{ $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Golongan</td>
                <td class="text-nowrap">{{ $pegawai->golongan->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Eselon</td>
                <td class="text-nowrap">{{ $pegawai->eselon->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Jabatan</td>
                <td class="text-nowrap">{{ $pegawai->jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Tempat Tugas</td>
                <td class="text-nowrap">{{ $pegawai->tempat_tugas ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Agama</td>
                <td class="text-nowrap">{{ $pegawai->agama ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Unit Kerja</td>
                <td class="text-nowrap">{{ $pegawai->unitKerja->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">No. HP</td>
                <td class="text-nowrap">{{ $pegawai->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">NPWP</td>
                <td class="text-nowrap">{{ $pegawai->npwp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Alamat</td>
                <td class="text-wrap">{{ $pegawai->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td class="text-nowrap">Foto</td>
                <td class="text-nowrap">
                    @if ($pegawai->foto)
                        <a href="{{ asset('storage/foto_pegawai/' . $pegawai->foto) }}" target="_blank">
                            <img src="{{ asset('storage/foto_pegawai/' . $pegawai->foto) }}" width="100" class="border">
                        </a>
                    @else
                        Tidak ada foto
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Informasi Pembuatan --}}
    <div class="d-flex justify-content-end text-end mt-4">
        <div>
            <span>Dibuat pada:</span> <span>{{ $pegawai->created_at ? $pegawai->created_at->translatedFormat('d F Y H:i') : '-' }}</span>
        </div>
    </div>
</div>
