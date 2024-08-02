<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\Hutang_dibayar;
use App\Models\Hutang_masuk;
use App\Models\Penghutang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $userID = Auth::id();

        $data_hutang = Hutang::where('user_id', $userID)
        ->where('status_hutang', 'belum_dibayar')
        ->count();

        $nominal_hutang = Hutang::where('user_id', $userID)
            ->sum('jumlah_hutang');

        $penghutang = Penghutang::join('hutang', 'penghutang.id', '=', 'hutang.penghutang_id')
            ->where('hutang.user_id', $userID)
            ->where('hutang.status_hutang', 'belum_dibayar')
            ->select('penghutang.*')
            ->distinct()
            ->count();

        $riwayat_hutang = Hutang_masuk::where('user_id', $userID)
            ->sum('nilai_hutang');
        
        $riwayat_dibayar = Hutang_dibayar::where('user_id', $userID)
            ->sum('jumlah_dibayar');


        return view('home/dashboard', compact('data_hutang','nominal_hutang','penghutang', 'riwayat_hutang', 'riwayat_dibayar'));
    }

    public function tambah_hutang(){
        $userID = Auth::id();
        $penghutang = Penghutang::where('user_id', $userID)->get();

        return view('hutang/tambah_hutang', compact('penghutang'));
    }

    public function lihat_penghutang(){
        $userID = Auth::id();
        $penghutang = Penghutang::where('user_id', $userID)->get();

        return view('penghutang/lihat_penghutang', compact('penghutang'));
    }

    public function tambah_penghutang(){
        return view('penghutang/tambah_penghutang');
    }

    public function update_penghutang(Request $request){
        try{
            $validate = $request->validate([
                'nama_penghutang' => 'required|string|max:255',
                'alamat_penghutang' => 'required',
                'no_wa' => 'required|digits_between:10,15',
            ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
           }
        $userID = Auth::id();

        $penghutang = new Penghutang();
        $penghutang->user_id = $userID;
        $penghutang->nama_penghutang = $validate['nama_penghutang'];
        $penghutang->alamat_penghutang = $validate['alamat_penghutang'];
        $penghutang->no_wa = $validate['no_wa'];
        $penghutang->save();

        session()->flash('penghutang_ditambahkan');
        return redirect()->route('penghutang.lihat');
    }

    public function hutang_masuk(Request $request){

        $validate = $request->validate([
            'penghutang_id' => 'required|exists:penghutang,id',
            'keterangan' => 'required|max:255',
            'nilai_hutang' => 'required|numeric',
        ]);

        $userID = Auth::id();
        $penghutangID = $validate['penghutang_id'];
        $keterangan = $validate['keterangan'];
        $nilai_hutang = $validate['nilai_hutang'];

        $tgl_tempo = Carbon::now()->addDay(30);

        $hutang = Hutang::firstOrCreate(
            ['penghutang_id' => $penghutangID],
            [
                'user_id' => $userID,
                'jumlah_hutang' => 0,
                'tgl_jatuh_tempo' => $tgl_tempo,
                'status_hutang' => 'belum_dibayar'
            ]
            );
        
        $hutang->increment('jumlah_hutang', $nilai_hutang);

        $jml_hutang = $hutang->jumlah_hutang;
        
        $hutang->update([
            'status_hutang' =>$jml_hutang > 0 ? 'belum_dibayar' : 'lunas',
        ]);
        
        Hutang_masuk::create([
            'user_id' => $userID,
            'penghutang_id' => $penghutangID,
            'keterangan' => $keterangan,
            'nilai_hutang' => $nilai_hutang,
        ]);

        session()->flash('hutang_masuk_berhasil');
        return redirect()->route('pilih_penghutang');
    }

    public function lihat_hutang(){
        $userID = Auth::id();
        $hutang = Hutang::with(['user', 'user'])
            ->where('user_id', $userID)
            ->where('status_hutang', 'belum_dibayar')
            ->orderBy('tgl_jatuh_tempo', 'desc')
            ->get();

        return view('hutang/lihat_hutang', compact('hutang'));
    }

    public function pilih_penghutang(){
        $userID = Auth::id();
        $penghutang = Penghutang::join('hutang', 'penghutang.id', '=', 'hutang.penghutang_id')
            ->where('hutang.user_id', $userID)
            ->where('hutang.status_hutang', 'belum_dibayar')
            ->select('penghutang.*')
            ->distinct()
            ->get();

        return view('hutang/pilih_penghutang', compact('penghutang'));
    }

    public function form_bayar_hutang($penghutang_id){
        $penghutang = Penghutang::with('hutang')->findOrFail($penghutang_id);

        return view('hutang/form_bayar_hutang', compact('penghutang'));
    }

    public function bayar_hutang(Request $request){

        $validate = $request->validate([
            'penghutang_id' => 'required|exists:penghutang,id',
            'keterangan' => 'required|max:255',
            'jumlah_dibayar' => 'required|numeric',
        ]);

        $userID = Auth::id();
        $penghutangID = $validate['penghutang_id'];
        $keterangan = $validate['keterangan'];
        $jumlah_dibayar = $validate['jumlah_dibayar'];

        $hutang = Hutang::where('penghutang_id', $penghutangID)->first();

        $hutang->decrement('jumlah_hutang', $jumlah_dibayar);

        $jml_hutang = $hutang->jumlah_hutang;
        
        $hutang->update([
            'status_hutang' =>$jml_hutang > 0 ? 'belum_dibayar' : 'lunas',
        ]);

        Hutang_dibayar::create([
            'user_id' => $userID,
            'penghutang_id' => $penghutangID,
            'keterangan' => $keterangan,
            'jumlah_dibayar' => $jumlah_dibayar,
        ]);

        session()->flash('hutang_dibayar');
        return redirect()->route('pilih_penghutang');
        
    }

    public function riwayat_masuk(){
        $userID = Auth::id();

        $hutang_masuk = Hutang_masuk::with(['user', 'penghutang'])
            ->where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat/riwayat_masuk', compact('hutang_masuk'));
    }

    public function riwayat_dibayar(){
        $userID = Auth::id();

        $hutang_dibayar = Hutang_dibayar::with(['user', 'penghutang'])
            ->where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat/riwayat_dibayar', compact('hutang_dibayar'));
    }

    public function form_ubah_hutang($penghutang_id, $id){
        $penghutangID = $penghutang_id;

        $hutangID = $id;

        $penghutang = Penghutang::where('id', $penghutang_id)->value('nama_penghutang');

        $jml_hutang = Hutang::where('penghutang_id', $penghutang_id)
            ->sum('jumlah_hutang');

        $jatuh_tempo = Hutang::where('penghutang_id', $penghutang_id)->value('tgl_jatuh_tempo');

        return view('hutang/form_ubah_hutang', compact('penghutangID','hutangID','penghutang', 'jml_hutang', 'jatuh_tempo'));
    }
    
    public function update_hutang(Request $request){
        try{
            $validate = $request->validate([
                'nama_penghutang' => 'required|max:500',
                'jumlah_hutang' => 'required|numeric',
                'tgl_jatuh_tempo' => 'required',
            ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
           }

           $userID = Auth::id();
           $penghutangID = $request->penghutang_id;
           $hutangID = $request->id;
           
           $penghutang = Penghutang::findOrFail($penghutangID);
           $penghutang->nama_penghutang = $validate['nama_penghutang'];
           $penghutang->save();

           $hutang = Hutang::findOrFail($hutangID);
           $hutang->jumlah_hutang = $validate['jumlah_hutang'];
           $hutang->tgl_jatuh_tempo = $validate['tgl_jatuh_tempo'];
           $hutang->save();

           session()->flash('hutang_diubah');
           return redirect()->route('lihat_hutang');

    }
}
