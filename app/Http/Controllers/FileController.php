<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // Upload foto pegawai
    public function uploadPhoto(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/photos');
            $pegawai->photo = basename($photoPath);
            $pegawai->save();
        }

        return redirect()->route('pegawai.data.index')->with('success', 'Photo uploaded successfully!');
    }

    // Menghapus file
    public function destroy($path_base64)
    {
        $path = base64_decode($path_base64);
        if (Storage::exists($path)) {
            Storage::delete($path);
            return response()->json(['success' => 'File deleted successfully']);
        }
        return response()->json(['error' => 'File not found'], 404);
    }
}
