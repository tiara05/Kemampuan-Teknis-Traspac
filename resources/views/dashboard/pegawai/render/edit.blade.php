<form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- STEP 1 --}}
    <div id="step-1">
        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="nip" class="required">NIP</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="nip" id="nip" class="form-control" required placeholder="Masukkan NIP"
                    value="{{ old('nip', $pegawai->nip) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="nama" class="required">Nama</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan Nama"
                    value="{{ old('nama', $pegawai->nama) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="tempat_lahir" class="required">Tempat Lahir</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required
                    placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="tanggal_lahir" class="required">Tanggal Lahir</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required
                value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('Y-m-d')) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
            </div>
            <div class="col-12 col-lg-8">
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="alamat" class="required">Alamat</label>
            </div>
            <div class="col-12 col-lg-8">
                <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukkan Alamat">{{ old('alamat', $pegawai->alamat) }}</textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="button" id="nextBtn" class="btn btn-sm btn-primary">Lanjut</button>
        </div>
    </div>

    {{-- STEP 2 --}}
    <div id="step-2" style="display: none;">
        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="golongan_id" class="required">Golongan</label>
            </div>
            <div class="col-12 col-lg-8">
                <select class="form-select select2" name="golongan_id" id="golongan_id" required>
                    <option value="">Pilih Golongan</option>
                    @foreach ($golongan as $g)
                        <option value="{{ $g->id }}" {{ old('golongan_id', $pegawai->golongan_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="eselon_id" class="required">Eselon</label>
            </div>
            <div class="col-12 col-lg-8">
                <select class="form-select select2" name="eselon_id" id="eselon_id" required>
                    <option value="">Pilih Eselon</option>
                    @foreach ($eselon as $e)
                        <option value="{{ $e->id }}" {{ old('eselon_id', $pegawai->eselon_id) == $e->id ? 'selected' : '' }}>
                            {{ $e->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="jabatan" class="required">Jabatan</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="jabatan" id="jabatan" class="form-control" required
                    placeholder="Masukkan Jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="tempat_tugas" class="required">Tempat Tugas</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="tempat_tugas" id="tempat_tugas" class="form-control" required
                    placeholder="Masukkan Tempat Tugas" value="{{ old('tempat_tugas', $pegawai->tempat_tugas) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="agama" class="required">Agama</label>
            </div>
            <div class="col-12 col-lg-8">
                <select name="agama" id="agama" class="form-select" required>
                    <option value="">Pilih Agama</option>
                    @foreach (['Islam', 'Kristen', 'Hindu', 'Buddha', 'Katholik', 'Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ old('agama', $pegawai->agama) == $agama ? 'selected' : '' }}>
                            {{ $agama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="unit_id" class="required">Unit Kerja</label>
            </div>
            <div class="col-12 col-lg-8">
                <select class="form-select select2" name="unit_id" id="unit_id" required>
                    <option value="">Pilih Unit Kerja</option>
                    @foreach ($unit as $u)
                        <option value="{{ $u->id }}" {{ old('unit_id', $pegawai->unit_id) == $u->id ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="no_hp" class="required">No. HP</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="no_hp" id="no_hp" class="form-control" required placeholder="Masukkan No. HP"
                    value="{{ old('no_hp', $pegawai->no_hp) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="npwp" class="required">NPWP</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="npwp" id="npwp" class="form-control" required placeholder="Masukkan NPWP"
                    value="{{ old('npwp', $pegawai->npwp) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="foto">Foto</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                @if ($pegawai->foto)
                    <small>Foto saat ini: <a href="{{ asset('storage/foto/' . $pegawai->foto) }}" target="_blank">Lihat</a></small>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" id="prevBtn" class="btn btn-sm btn-secondary">Kembali</button>
            <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
        </div>
    </div>
</form>

<script>
    $('#nextBtn').on('click', function () {
        $('#step-1').hide();
        $('#step-2').show();
    });

    $('#prevBtn').on('click', function () {
        $('#step-2').hide();
        $('#step-1').show();
    });
</script>
