<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Gaji;
use App\Models\Kehadiran;
use App\Models\PK;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function absensi()
    {
        $absensi = Absensi::all();
        return view('user.absensi', compact('absensi'));
    }

    public function detailAbsensi($id)
    {
        $user_id = Auth::id();
        $today = Carbon::now()->toDateString(); // Format: Y-m-d
        $now = Carbon::now()->toTimeString(); // Format: H:i:s

        $absensi = Absensi::findOrFail($id);

        // dd($now, $absensi->jam_masuk, $absensi->batas_jam_masuk);

        // Cek apakah user sudah absen masuk hari ini
        $absenMasuk = Kehadiran::where('id_user', $user_id)
            ->where('id_absensi', $id)
            ->whereDate('tanggal', $today)
            ->whereNotNull('jam_masuk')
            ->exists();

        // Cek apakah user sudah absen pulang hari ini
        $absenPulang = Kehadiran::where('id_user', $user_id)
            ->where('id_absensi', $id)
            ->whereDate('tanggal', $today)
            ->whereNotNull('jam_pulang')
            ->exists();

        // Cek apakah waktu sekarang dalam rentang jam masuk dan batas jam masuk
        $canAbsenMasuk = !$absenMasuk && ($now <= $absensi->batas_jam_masuk) && ($now >= $absensi->jam_masuk);

        // Cek apakah waktu sekarang dalam rentang jam pulang dan batas jam pulang
        $canAbsenPulang = !$absenPulang && ($now >= $absensi->jam_pulang) && ($now <= $absensi->batas_jam_pulang);

        $user = Auth::user();
        // Asumsikan Anda memiliki model PK untuk mengambil data PK
        $dataPK = PK::all();

        return view('user.detailAbsensi', compact('absensi', 'user', 'dataPK', 'absenMasuk', 'absenPulang', 'canAbsenMasuk', 'canAbsenPulang'));
    }

    public function absenMasuk(Request $request)
    {
        $kehadiran = new Kehadiran();
        $kehadiran->id_user = $request->user_id;
        $kehadiran->id_absensi = $request->absensi_id;
        $kehadiran->jam_masuk = $request->jam_masuk;
        $kehadiran->id_pk = $request->jenis_pk;
        $kehadiran->jumlah_pk = $request->jumlah_pk;
        $kehadiran->tanggal = $request->tanggal;
        $kehadiran->status = "hadir";

        // dd($request->all());

        $kehadiran->save();

        Session::put('kehadiran_id', $kehadiran->id_kehadiran);

        Session::flash('success', 'Absen Masuk berhasil.');

        return redirect()->route('user.absensi');
    }

    public function absenPulang(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $request->validate([
            'user_id' => 'required|integer',
            'absensi_id' => 'required|integer',
            'kehadiran_id' => 'required|integer',
            'jam_pulang' => 'required',
            'pk_selesai' => 'required|integer',
            'pk_belum' => 'required|integer',
            'tanggal' => 'required|date'
        ]);



        // Cari kehadiran berdasarkan id_kehadiran
        $kehadiran = Kehadiran::where('id_kehadiran', $request->kehadiran_id)
            ->where('id_user', $request->user_id)
            ->where('id_absensi', $request->absensi_id)
            ->firstOrFail();

        // Update data kehadiran
        $kehadiran->jam_pulang = $request->jam_pulang;
        $kehadiran->pk_selesai = $request->pk_selesai;
        $kehadiran->pk_belum = $request->pk_belum;
        $kehadiran->tanggal = $request->tanggal;
        $kehadiran->status = "hadir";
        $kehadiran->save();

        Session::flash('success', 'Absen Pulang berhasil.');
        return redirect()->route('user.absensi');
    }


    public function viewGaji()
    {
        $gaji = Gaji::where('user_id', Auth::user()->id)->get();
        return view('user.gaji', compact('gaji'));
    }
}
