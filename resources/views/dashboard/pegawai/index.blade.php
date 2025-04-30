@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" x-data="{ openCreate: false, editModal: false, editData: {} }">
    <div class="d-lg-flex justify-content-between align-items-center mb-4">
        <span class="fs-5 d-block mb-2 mb-lg-0" style="font-weight: 400"></span>
        <form action="" method="get" class="d-flex gap-2">
            @foreach (request()->except(['search', 'availability']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input type="search" class="form-control bg_transparent_1" name="search" id="search" placeholder="Search"
                value="{{ request('search') }}" />
            <select name="unit_id" class="form-select bg_transparent_1" onchange="this.form.submit()">
                <option value="">Semua Unit</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
            <select class="form-select bg_transparent_1" name="order" id="order"
                onchange="$(this).closest('form').submit()">
                <option value="">Sort</option>
                <option value="latest" {{ request('order') == 'latest' ? 'selected' : '' }}>Latest</option>
                <option value="oldest" {{ request('order') == 'oldest' ? 'selected' : '' }}>Oldest</option>
            </select>
            <button type="button" class="btn-primary btn btn_theme ajax_modal_btn" title="Add" data-modal-title="Tambah Pegawai"
                data-modal-size="lg" data-render-route="{{ route('pegawai.create') }}">
                Tambah Pegawai
            </button>
        </form>
    </div>

    @if(session('error'))
        <div class="bg-green-500 text-white p-2 rounded mt-4">{{ session('error') }}</div>
    @endif

    <a href="{{ route('pegawai.cetak.pdf', request()->all()) }}" class="btn btn-danger" target="_blank">
        Unduh PDF
    </a>

    <a href="{{ route('pegawai.export.excel') }}" class="btn btn-success">Unduh Daftar Pegawai (Excel)</a>


    <div class="table-responsive">
        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Golongan</th>
                    <th>Unit Kerja</th>
                    <th>Eselon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawai as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="javascript:void(0)" class="text-info ajax_modal_btn" title="Detail"
                                        data-modal-title="Detail Instalation" data-modal-size="lg"
                                        data-render-route="{{ route('pegawai.show', $item->id) }}">
                                        {{ $item->nip ?? 'N/A' }}</a></td>
                        <td>{{ $item->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->golongan->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $item->unitKerja->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $item->eselon->name ?? 'N/A' }}</td>
                        <td>
                            <button type="button" 
                                    class="btn btn-sm btn-warning ajax_modal_btn" 
                                    title="Edit"
                                    data-modal-title="Edit Pegawai" 
                                    data-modal-size="lg"
                                    data-render-route="{{ route('pegawai.edit', $item->id) }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger ajax_modal_btn" title="Delete"
                                data-modal-title="Delete Pegawai"
                                data-render-route="{{ route('pegawai.delete', $item->id) }}">Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pegawai->links() }}
        </div>
    </div>
</div>
@endsection
