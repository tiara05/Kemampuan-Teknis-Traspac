<form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- STEP 1 --}}
    <div id="step-1">
        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="nip" class="required">NIP</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="nip" id="nip" class="form-control" required placeholder="Masukkan NIP">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="nama" class="required">Nama</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan Nama">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="tempat_lahir" class="required">Tempat Lahir</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required placeholder="Masukkan Tempat Lahir">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="tanggal_lahir" class="required">Tanggal Lahir</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
            </div>
            <div class="col-12 col-lg-8">
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="alamat" class="required">Alamat</label>
            </div>
            <div class="col-12 col-lg-8">
                <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukkan Alamat"></textarea>
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
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
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
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="jabatan" class="required">Jabatan</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="jabatan" id="jabatan" class="form-control" required placeholder="Masukkan Jabatan">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="tempat_tugas" class="required">Tempat Tugas</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="tempat_tugas" id="tempat_tugas" class="form-control" required placeholder="Masukkan Tempat Tugas">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="agama" class="required">Agama</label>
            </div>
            <div class="col-12 col-lg-8">
                <select name="agama" id="agama" class="form-select" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Katholik">Katholik</option>
                    <option value="Konghucu">Konghucu</option>
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
                    @foreach ($unit as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="no_hp" class="required">No. HP</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="no_hp" id="no_hp" class="form-control" required placeholder="Masukkan No. HP">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="npwp" class="required">NPWP</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="text" name="npwp" id="npwp" class="form-control" required placeholder="Masukkan NPWP">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-4 mb-1">
                <label for="foto">Foto</label>
            </div>
            <div class="col-12 col-lg-8">
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" id="prevBtn" class="btn btn-sm btn-secondary">Kembali</button>
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
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
