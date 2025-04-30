<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik untuk ditampilkan di dashboard
        $totalPegawai = Pegawai::count();
        $totalUnit = Unit::count();
        $newestPegawai = Pegawai::orderBy('created_at', 'desc')->limit(5)->get();

        // Data ini bisa dikirimkan ke view dashboard untuk ditampilkan
        return view('layouts/app', compact('totalPegawai', 'totalUnit', 'newestPegawai'));
    }
}
