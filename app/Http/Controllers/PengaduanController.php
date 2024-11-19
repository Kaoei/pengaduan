<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{

    public function index()
    {
        $pengaduans = Pengaduan::all();
        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request){
        $request->validate([
            'tgl_pengaduan' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'required',
        ]);

        $foto = $request->file('foto');
        $nama_file = time()."_".$foto->getClientOriginalName();
        $tujuan_upload = 'foto_pengaduan';
        $foto->move($tujuan_upload, $nama_file);

        Pengaduan::create([
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'user_id' => Auth::user()->id,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $nama_file,
            'status' => 'proses'
        ]);

        return redirect()->route('pengaduan')->with('success', 'Pengaduan berhasil dikirim');

    }

    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::find($id);
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_pengaduan' => 'required',
            'isi_laporan' => 'required',
        ]);

        $pengaduan = Pengaduan::find($id);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_file = time()."_".$foto->getClientOriginalName();
            $tujuan_upload = 'foto_pengaduan';
            $foto->move($tujuan_upload, $nama_file);
            $pengaduan->foto = $nama_file;
        }

        $pengaduan->tgl_pengaduan = $request->tgl_pengaduan;
        $pengaduan->user_id = Auth::user()->id;
        $pengaduan->isi_laporan = $request->isi_laporan;
        $pengaduan->status = 'proses';
        $pengaduan->save();

        return redirect()->route('pengaduan')->with('success', 'Pengaduan berhasil diubah');
    }

    public function destroy($id)
    {
        Pengaduan::find($id)->delete();
        return redirect()->route('pengaduan')->with('success', 'Pengaduan berhasil dihapus');
    }

}
