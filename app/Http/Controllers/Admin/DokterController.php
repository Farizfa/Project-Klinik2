<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\PoliModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DokterController extends Controller
{

    public function index()
    {
        $data = DokterModel::all();
        $poli = PoliModel::all();
        return view ('admin.dokter', compact('data','poli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:table_poli,id',
        ]);

        try {
            DokterModel::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_poli' => $request->id_poli,
            ]);
    
            Alert::success('Berhasil!', 'Dokter ' . $request->name . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage());
        }

        return redirect()->route('admin.dokter');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:table_poli,id',
        ]);

        try {
            $data = DokterModel::findOrFail($id);
            $data->update([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_poli' => $request->id_poli,
            ]);
    
            Alert::success('Berhasil!', 'Data Dokter ' . $request->name . ' berhasil terupdate.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat mengupdate data. ' . $e->getMessage());
        }

        return redirect()->route('admin.dokter');
    }

    public function destroy($id)
    {
        try {
            $dokter = DokterModel::findOrFail($id);
            $dokter->delete();

            Alert::success('Berhasil!', 'Data Dokter berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menghapus data. ' . $e->getMessage());
        }

        return redirect()->route('admin.dokter');
    }
}
