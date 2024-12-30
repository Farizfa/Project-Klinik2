<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ObatModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends Controller
{
    public function index()
    {
        $data = ObatModel::all();
        return view('admin.obat', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer',
        ]);

        try {
            ObatModel::create([
                'nama_obat' => $request->nama_obat,
                'kemasan' => $request->kemasan,
                'harga' => $request->harga,
            ]);
    
            Alert::success('Berhasil!', 'Data ' . $request->nama_obat . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage());
        }

        return redirect()->route('admin.obat');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer',
        ]);

        try {
            $data = ObatModel::findOrFail($id);
            $data->update([
                'nama_obat' => $request->nama_obat,
                'kemasan' => $request->kemasan,
                'harga' => $request->harga,
            ]);
    
            Alert::success('Berhasil!', 'Data ' . $request->name . ' berhasil terupdate.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat mengupdate data. ' . $e->getMessage());
        }

        return redirect()->route('admin.obat');
    }

    public function destroy($id)
    {
        try {
            $obat = ObatModel::findOrFail($id);
            $obat->delete();

            Alert::success('Berhasil!', 'Data Obat berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menghapus data. ' . $e->getMessage());
        }

        return redirect()->route('admin.obat');
    }
    
}
