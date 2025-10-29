<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\UserExport;

class UserController extends Controller
{

    public function register(Request $request)
    {

        //request $request : mengambil value request/input
        //dd() : debugging. cek data sebelum diproses lebih lanjut
        // dd($request->all());

        // validasi data
        $request->validate([
            //format : 'name_input' => 'rule_validasi'
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            // email:dns -> memastikan domain email valid
            'email' => 'required | email:dns',
            'password' => 'required',
        ], [
            //custom pesan
            //format : 'name_input.validasi' => 'pesan error'
            'first_name.required' => 'First name wajib diisi',
            'first_name.min' => 'First name minimal 3 karakter',
            'last_name.required' => 'Last name wajib diisi',
            'last_name.min' => 'Last name minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'email diisi dengan data valid',
            'password.required' => 'Password wajib diisi',
        ]);

        //eloquent (fungsi model) tambah data baru : create ([])
        $createData = user::create([
            // 'column' => $request -> name_input
            'name' => $request->first_name . "". $request->last_name,
            'email' => $request->email,
            //enkripsi data : mengubah menjadi data acak, tidak ada yang bisa tau isi datanya : hash::make()
            'password' => Hash::make($request->password),
            //role diisi langsung sebagai user agar ridak bisa menjadi admin/staff
            'role' => 'user',


        ]);

        if ($createData){
            //redirect : mengirim ulang ke halaman tertentu
            //route() : mengambil route berdasarkan nama
            return redirect()->route('login')->with('success', 'berhasil membuat akun Silahkan login');
        } else {
            //back() : mengembalikan ke halaman sebelumnya
            return redirect()->back()->with('error', 'gagal membuat akun Silahkan coba lagi');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Users = User::all();
        return view('admin.user.index', compact('Users'));

    }

    public function datatables()
    {
        // 1. Ambil data pengguna. Gunakan query() untuk efisiensi
        $users = User::query();

        return DataTables::of($users)
            // Tambahkan kolom penomor (No. urut)
            ->addIndexColumn()

            // Kolom kustom 'action' (sesuai permintaan DataTables)
            ->addColumn('action', function(User $user) {
                // Definisikan tombol aksi di sini
                $btnEdit = '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-primary btn-sm me-2">Edit</a>';

                // Form Hapus (menggunakan method DELETE)
                $btnDelete = '<form action="'. route('admin.users.delete', $user->id) .'" method="POST" style="display:inline;">' .
                                    csrf_field() . // Token CSRF
                                    method_field('DELETE') .'
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin Hapus Pengguna: ' . $user->name . '?\')">Hapus</button>
                                </form>';

                // Mengembalikan HTML untuk kolom 'action'
                return '<div class="d-flex">' . $btnEdit . $btnDelete . '</div>';
            })

            // Tentukan kolom mana yang mengembalikan HTML mentah (kolom 'action')
            ->rawColumns(['action'])

            ->make(true);
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
        //menyimpan data yang akan diverifikasi
        $data = $request->only('email', 'password');
        //Auth::attempt() : verifikasi kecocokan email-pw atau username-pw
        if ( Auth::attempt($data)){
            //mengecek role setelah login, apakah sebagai admin atau pengguna
            if(Auth::user()->role == "admin") {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil login');
            } else {
                return redirect()->route('home')->with('success','berhasil login');
            }
        } else  {
            return redirect()->back()->with('error', 'Gagal! pastikan email dan password sesuai');
        }
    }

    public function logout()
    {

        //Auth::logout() : hapus sesi login
        Auth::logout();
        return redirect()->route('home')->with('logout', 'anda sudah logout silahkan login kembali');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data
        $request->validate( [
            'name' =>'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email diisi dengan format yang benar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);
        $createData = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);
        if ($createData){
            return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan user');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' =>'required',
            'email' => 'required|email:dns|unique:users,email,'.$id,
            'password' => 'nullable',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);
        $updateData = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            //jika password diisi maka diupdate, jika tidak diisi maka tidak diupdate
            'password' => Hash::make($request->password),
            // 'password' => $request->password ? Hash::make($request->password) : $request->old_password,
        ]);
        if ($updateData) {
            return redirect()->route('admin.users.index')->with('success','staff berhasil diedit');
        } else {
            return redirect()->back()->with('error','staff gagal ditambahkan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

    if ($user) {
        $user->delete(); // soft delete
        return redirect()->route('admin.users.index')->with('success', 'Berhasil menghapus data (soft delete)');
    } else {
        return redirect()->route('admin.users.index')->with('error', 'User tidak ditemukan');
    }
    }

    public function exportExcel()
    {
        $fileName = 'data-pengguna.xlsx';
        return Excel::download(new UserExport, $fileName);
    }

    public function trash() {
        $userTrash = User::onlyTrashed()->get();
        return view('admin.user.trash', compact('userTrash'));
    }

    public function restore($id) {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.users.index')->with('success', 'data berhasil dikembalikkan');
    }

    public function deletePermanent($id) {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'berhasil hapus data secara permanen');
    }
}
