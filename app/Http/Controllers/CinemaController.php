<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CinemaExport;
use App\Models\Schedule;
use Yajra\DataTables\Facades\DataTables;

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
        return view('admin.cinema.index');
    }

    public function datatables()
    {
        $cinemas = Cinema::query(); // Menggunakan query() untuk efisiensi

        return DataTables::of($cinemas)
            ->addIndexColumn()
            // Kolom 'btnActions' untuk tombol Edit, Delete, dll.
            ->addColumn('btnActions', function(Cinema $cinema) {
                $btnEdit = '<a href="' . route('admin.cinemas.edit', $cinema->id) . '" class="btn btn-primary btn-sm me-2">Edit</a>';

                $btnDelete = '<form action="'. route('admin.cinemas.delete', $cinema->id) .'" method="POST" style="display:inline;">' .
                                    csrf_field() .
                                    method_field('DELETE') .'
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin Hapus Bioskop: ' . $cinema->name . '?\')">Hapus</button>
                                </form>';

                return '<div class="d-flex">' . $btnEdit . $btnDelete . '</div>';
            })
            ->rawColumns(['btnActions']) // Mengizinkan rendering HTML untuk kolom aksi
            ->make(true);
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
        $schedules = Schedule::where('cinema_id', $id)->count();
        if ($schedules) {
            return redirect()->route('admin.cinemas.index')->with('error', 'tidak dapat menghapus data bioskop data tertaut dengan jadwal tayang');
        }
        //
        Cinema::where('id', $id)->delete();
        return redirect()->route('admin.cinemas.index')->with('success', 'berhasil menghapus data');
    }
      public function exportExcel()
    {
        $fileName = 'data-bioskop.xlsx';
        return Excel::download(new CinemaExport, $fileName);
    }

    public function trash() {
        $cinemaTrash = Cinema::onlyTrashed()->get();
        return view('admin.cinema.trash', compact('cinemaTrash'));
    }

    public function restore($id) {
        $cinema = Cinema::onlyTrashed()->find($id);
        $cinema->restore();
        return redirect()->route('admin.cinemas.index')->with('success', 'berhasil mengembalikan data');
    }

    public function deletePermanent($id) {
        $cinema = Cinema::onlyTrashed()->find($id);
        $cinema->forceDelete();
        return redirect()->back()->with('success', 'berhasil menghapus data secara permanen');
    }

    public function cinemaList() {
        $cinemas = Cinema::all();
        return view('schedule.cinema', compact('cinemas'));
    }

     public function cinemaSchedules($cinema_id) {
    $schedules = Schedule::where('cinema_id', $cinema_id)->with('movie')->whereHas('movie', function($q){
        $q->where('activated', 1);
    })->get();

    return view('schedule.cinema-schedules', compact('schedules'));
}
}
