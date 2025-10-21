<?php

namespace App\Http\Controllers;

use App\Models\cinema;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CinemaExport;
use App\Models\Schedule;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Cinemas = Cinema::all();
        // Cinema::all(); -> mengambil semua data pada model cinema (table cinemas)
        // mengirim data dari controller ke blade -> impact()
        // isi compact sama dengan nama variable
        // eloquent model
        return view('admin.cinema.index', compact('Cinemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //validasi data
        $request->validate([
            'name' =>'required',
            'location' => 'required|min:10'
        ], [
            'name.required' => 'Nama bioskop wajib diisi',
            'location.required' => 'Lokasi bioskop wajib diisi',
            'location.min' => 'Lokasi minimal 10 karakter',
        ]);
        $createData = Cinema::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);
        if ($createData) {
            return redirect()->route('admin.cinemas.index')->with('success', 'Bioskop berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Bioskop gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cinema $cinema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $cinema = Cinema::find($id);
        return view('admin.cinema.edit', compact('cinema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' =>'required',
            'location' => 'required|min:10'
        ], [
            'name.required' => 'Nama bioskop harus diisi',
            'location.required' => 'Lokasi bioskop harus diisi',
            'location.min' => 'Lokasi minimal 10 karakter',
        ]);
        //where() -> mencari data, format : where('nama_colomn','value')
        // sebelum update() wajib ada where() untuk mencari data yang akan diupdatenya
        $updateData = Cinema::where('id', $id)->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);
        if ($updateData) {
            return redirect()->route('admin.cinemas.index')->with('succcess', 'berhasil mengubah data');

        } else {
            return redirect()->back()->with('error', 'gagal! coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Cinema::where('id', $id)->delete();
        return redirect()->route('admin.cinemas.index')->with('success', 'berhasil menghapus data');
    }
      public function exportExcel()
    {
        $fileName = 'data-bioskop.xlsx';
        return Excel::download(new CinemaExport, $fileName);
    }
}
