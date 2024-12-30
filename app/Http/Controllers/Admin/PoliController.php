<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PoliModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PoliController extends Controller
{
    public function index()
    {
        $data = PoliModel::all();
        return view('admin.poli', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:table_poli,name|string|max:255',
            'keterangan' => 'required|string|max:500',
        ]);

        try {
            PoliModel::create([
                'name' => $request->name,
                'keterangan' => $request->keterangan,
            ]);
    
            Alert::success('Berhasil!', 'Data Poli ' . $request->name . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage());
        }

        return redirect()->route('admin.poli');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:table_poli,name,' . $id,
            'keterangan' => 'required|string|max:500',
        ]);

        try {
            $data = PoliModel::findOrFail($id);
            $data->update([
                'name' => $request->name,
                'keterangan' => $request->keterangan,
            ]);
    
            Alert::success('Berhasil!', 'Data Poli ' . $request->name . ' berhasil terupdate.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat mengupdate data. ' . $e->getMessage());
        }

        return redirect()->route('admin.poli');
    }

    public function destroy($id)
    {
        try {
            $data = PoliModel::findOrFail($id);
        
            if ($data->doctors()->exists()) {
                Alert::info('Perhatian!', 'Data Poli ini tidak dapat dihapus karena masih digunakan oleh Dokter.');
            } else {
                $data->delete();
                Alert::success('Berhasil!', 'Data Poli berhasil dihapus.');
            }
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menghapus data. ' . $e->getMessage());
        }

        return redirect()->route('admin.poli');
    }


}
