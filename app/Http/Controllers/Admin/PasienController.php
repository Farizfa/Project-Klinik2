<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
{
    public function authenticate(Request $request)
    {
        $validate = $request->only('name', 'no_ktp');
        
        if (Auth::guard('pasien')->attempt($validate)) {
            return redirect()->route('pasien.dashboard');
        }

        return back()->withErrors(['name' => 'Name atau password salah.']);
    }

    public function index()
    {
        $data = User::all();
        return view('admin.pasien', compact('data'));
    }

    private function NoRM()
    {
        $yearMonth = Carbon::now()->format('Ym');

        $lastPatient = User::where('no_rm', 'like', $yearMonth . '%')
                           ->orderBy('no_rm', 'desc')
                           ->first();

        $lastNo = $lastPatient ? (int)substr($lastPatient->no_rm, -3) : 0;
        $nextNo = str_pad($lastNo + 1, 3, '0', STR_PAD_LEFT);

        return $yearMonth . '-' . $nextNo;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_ktp' => 'required|string|max:16|unique:users',
            'no_hp' => 'required|string|max:15',
        ]);

        try {
            $no_rm = $this->NoRM();

            User::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
                'no_rm' => $no_rm,  
            ]);
    
            Alert::success('Berhasil!', 'Pasien ' . $request->name . ' berhasil ditambahkan dengan No RM: ' . $no_rm);
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage());
        }

        return redirect()->route('admin.pasien');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp,' . $id,
            'no_hp' => 'required|string|max:15',
        ]);

        try {
            $data = User::findOrFail($id);
            $data->update([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
            ]);
    
            Alert::success('Berhasil!', 'Data pasien ' . $request->name . ' berhasil terupdate.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat mengupdate data. ' . $e->getMessage());
        }

        return redirect()->route('admin.pasien');
    }

    public function destroy($id)
    {
        try {
            $pasien = User::findOrFail($id);
            $pasien->delete();

            Alert::success('Berhasil!', 'Data pasien berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat menghapus data. ' . $e->getMessage());
        }

        return redirect()->route('admin.pasien');
    }
}
