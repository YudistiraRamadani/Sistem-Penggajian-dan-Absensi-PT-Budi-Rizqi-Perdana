<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Kehadiran;
use App\Models\PK;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil nama pengguna yang sedang login
        $userName = auth()->user()->name;

        // Menghitung jumlah data Jabatan
        $jabatanCount = Jabatan::count();

        // Menghitung jumlah data PK
        $pkCount = PK::count();

        // Menghitung jumlah data User
        $userCount = User::count();

        // Mengirim data ke view
        return view('admin.dashboard', compact('userName', 'jabatanCount', 'pkCount', 'userCount'));
    }

    public function viewJabatan()
    {
        $jabatan = Jabatan::all();
        return view('admin.viewJabatan', compact('jabatan'));
    }

    public function storeJabatan()
    {
        return view('admin.inputJabatan');
    }


    public function tambahJabatan(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        Session::flash('success', 'Jabatan berhasil ditambahkan!');

        return redirect()->route('admin.dataJabatan');
    }

    public function editJabatan(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required',
        ]);

        $jabatan = Jabatan::FindOrFail($id);
        if (!$jabatan) {
            Session::flash('error', 'Data Jabatan tidak ditemukan!');
            return redirect()->route('admin.dataJabatan');
        }
        $jabatan->fill([
            'nama_jabatan' => $request->nama_jabatan,
        ])->save();

        Session::flash('success', 'Jabatan berhasil diperbarui!');

        return redirect()->route('admin.dataJabatan');
    }

    public function deleteJabatan(Request $request)
    {
        $jabatan = Jabatan::FindOrFail($request->id_jabatan);
        if (!$jabatan) {
            Session::flash('error', 'Data Jabatan tidak ditemukan!');
            return redirect()->route('admin.dataJabatan');
        }

        $jabatan->delete();

        Session::flash('success', 'Jabatan berhasil dihapus!');

        return redirect('/admin/viewJabatan');
    }


    public function viewKaryawan()
    {
        $karyawan = User::all();
        $jabatanList = Jabatan::all();
        return view('admin.viewKaryawan', compact('karyawan', 'jabatanList'));
    }


    public function editKaryawan(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        if (!$karyawan) {
            Session::flash('error', 'Data Karyawan tidak ditemukan!');
            return redirect()->route('admin.dataKaryawan');
        }



        $request->validate([
            'nama_karyawan' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'jabatan' => 'required',
            'role' => 'required',
        ]);


        $karyawan->fill([
            'name' => $request->nama_karyawan,
            'email' => $request->email,
            'id_jabatan' => $request->jabatan,
            'role' => $request->role,
        ]);



        $karyawan->save();


        Session::flash('success', 'Karyawan berhasil diperbarui!');

        return redirect()->route('admin.dataKaryawan');
    }



    public function hapusKaryawan(Request $request)
    {
        $karyawan = User::FindOrFail($request->id_karyawan);
        if (!$karyawan) {
            Session::flash('error', 'Data Karyawan tidak ditemukan!');
            return redirect()->route('admin.dataKaryawan');
        }

        $karyawan->delete();

        Session::flash('success', 'Karyawan berhasil dihapus!');

        return redirect('/admin/viewKaryawan');
    }


    public function tambahKaryawan(Request $request)
    {
        // dd('tambah karyawan');
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'jabatan_id' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        // dd($request->all());

        $karyawan = new User();
        $karyawan->name = $request->name;
        $karyawan->email = $request->email;
        $karyawan->id_jabatan = $request->jabatan_id;
        $karyawan->role = $request->role;
        $karyawan->password = Hash::make($request->password);

        // dd('before-save');

        $karyawan->save();

        // dd('after-save');

        Session::flash('success', 'Karyawan berhasil ditambahkan!');

        return redirect()->route('admin.dataKaryawan');
    }
    public function viewPK()
    {
        $pk = PK::all();
        return view('admin.viewPK', compact('pk'));
    }


    public function editPK(Request $request, $id)
    {
        $pk = PK::findOrFail($id);

        if (!$pk) {
            Session::flash('error', 'Data PK tidak ditemukan!');
            return redirect()->route('admin.dataPK');
        }



        $request->validate([
            'nama_pk' => 'required',
            'harga_pk' => 'required',

        ]);


        $pk->fill([
            'nama_pk' => $request->nama_pk,
            'harga_pk' => $request->harga_pk,
        ]);



        $pk->save();


        Session::flash('success', 'Data PK berhasil diperbarui!');

        return redirect()->route('admin.dataPK');
    }



    public function hapusPK(Request $request)
    {
        $pk = PK::FindOrFail($request->id_pk);
        if (!$pk) {
            Session::flash('error', 'Data PK tidak ditemukan!');
            return redirect()->route('admin.dataPK');
        }

        $pk->delete();

        Session::flash('success', 'Data PK berhasil dihapus!');

        return redirect('/admin/viewPK');
    }


    public function tambahPK(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
        ]);

        $pk = new PK();
        $pk->nama_pk = $request->nama;
        $pk->harga_pk = $request->harga;
        $pk->save();

        // dd('after-save');

        Session::flash('success', 'Data PK berhasil ditambahkan!');

        return redirect()->route('admin.dataPK');
    }


    public function tambahAbsensi(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'jam_masuk' => 'required',
            'batas_jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'batas_jam_pulang' => 'required',
        ]);

        $absensi = new Absensi();
        $absensi->judul_absensi = $request->judul;
        $absensi->deskripsi_absensi = $request->deskripsi;
        $absensi->jam_masuk = $request->jam_masuk;
        $absensi->batas_jam_masuk = $request->batas_jam_masuk;
        $absensi->jam_pulang = $request->jam_pulang;
        $absensi->batas_jam_pulang = $request->batas_jam_pulang;
        $absensi->save();

        Session::flash('success', 'Absensi berhasil ditambahkan!');

        return redirect()->route('admin.dataAbsensi');
    }

    public function editAbsensi(Request $request, $id)
    {
        $absensi = Absensi::FindOrFail($id);
        if (!$absensi) {
            Session::flash('error', 'Data Absensi tidak ditemukan!');
            return redirect()->route('admin.dataAbsensi');
        }

        $request->validate([
            'judul_absensi' => 'required',
            'deskripsi_absensi' => 'required',
            'jam_masuk' => 'required',
            'batas_jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'batas_jam_pulang' => 'required',
        ]);

        $absensi->fill([
            'judul_absensi' => $request->judul_absensi,
            'deskripsi_absensi' => $request->deskripsi_absensi,
            'jam_masuk' => $request->jam_masuk,
            'batas_jam_masuk' => $request->batas_jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'batas_jam_pulang' => $request->batas_jam_pulang,
        ])->save();

        Session::flash('success', 'Absensi berhasil diperbarui!');

        return redirect()->route('admin.dataAbsensi');
    }

    public function hapusAbsensi(Request $request)
    {
        $absensi = Absensi::FindOrFail($request->id_absensi);
        if (!$absensi) {
            Session::flash('error', 'Data Absensi tidak ditemukan!');
            return redirect()->route('admin.dataAbsensi');
        }

        $absensi->delete();

        Session::flash('success', 'Absensi berhasil dihapus!');

        return redirect('/admin/viewAbsensi');
    }


    public function viewAbsensi()
    {
        $absensi = Absensi::all();
        return view('admin.viewAbsensi', ['absensi' => $absensi]);
    }

    public function viewKehadiran()
    {
        $absensi = Absensi::all();
        return view('admin.viewKehadiran', ['absensi' => $absensi]);
    }


    public function viewDetailKehadiran($id)
    {
        $absensi = Absensi::findOrFail($id);
        $detailKehadiran = Kehadiran::where('id_absensi', $id)->get(); // Asumsi tabel Kehadiran menyimpan detail kehadiran

        // dd($detailKehadiran);


        return view('admin.viewDetailKehadiran', ['absensi' => $absensi, 'detailKehadiran' => $detailKehadiran]);
    }


    public function viewGaji()
    {
        $users = User::all();
        return view('admin.viewGaji', ['users' => $users]);
    }

    public function viewFormGaji(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:users,id',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date'
        ]);

        $id_user = $request->input('id_karyawan');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $user = User::findOrFail($id_user);
        $kehadiran = Kehadiran::where('id_user', $id_user)
            ->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->get();

        $total_masuk = $kehadiran->count();

        $pkDetails = Kehadiran::select(
            'pk.nama_pk',
            'pk.harga_pk',
            DB::raw('SUM(kehadiran.pk_selesai) as total_pk_selesai')
        )
            ->join('pk', 'kehadiran.id_pk', '=', 'pk.id_pk')
            ->where('kehadiran.id_user', $id_user)
            ->whereBetween('kehadiran.tanggal', [$tanggal_awal, $tanggal_akhir])
            ->groupBy('pk.nama_pk', 'pk.harga_pk')
            ->get();

        // Calculate total gaji
        $total_gaji = $pkDetails->sum(function ($pk) {
            return $pk->total_pk_selesai * $pk->harga_pk;
        });

        return view('admin.viewFormGaji', [
            'user' => $user,
            'total_masuk' => $total_masuk,
            'kehadiran' => $kehadiran,
            'pkDetails' => $pkDetails,
            'total_gaji' => $total_gaji,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
    }

    public function storeGaji(Request $request)
    {
        $tgl = Carbon::now()->format('Y-m-d');
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'total_masuk' => 'required|integer',
            'total_gaji' => 'required',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date'
        ]);

        // Menyimpan data gaji ke dalam database, sesuaikan dengan struktur tabel Anda
        Gaji::create([
            'user_id' => $request->id_user,
            'total_masuk' => $request->total_masuk,
            'total_gaji' => $request->total_gaji,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'tanggal' => $tgl
        ]);

        Session::flash('success', 'Data gaji berhasil ditambahkan!');

        return redirect()->route('admin.viewDataGaji');
    }


    public function viewDatagaji()
    {
        $gajis = Gaji::all();
        return view('admin.viewDatagaji', compact('gajis'));
    }

    public function deleteGaji(Request $request)
    {
        $gaji = Gaji::findOrFail($request->id_gaji);
        $gaji->delete();

        Session::flash('success', 'Data gaji berhasil dihapus!');

        return redirect()->route('admin.viewDataGaji');
    }
}
