<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use App\Models\user;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/schedules', function () {
    return view('schedule.detail-film');
})->name('schedules.detail');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

//httpmethod
//1. get -> untuk mengambil data dan menampilkan halaman
//2. post -> untuk mengirim data baru ke server/backend
//3. patch/put -> untuk mengubah/mengupdate sebagian data
//4. delete -> untuk menghapus data

Route::post('/singup', [UserController::class, 'register'])->name('signup.register');
Route::post('/login',[UserController::Class, 'loginAuth'])->name('login.auth');
Route::get('/logout',[UserController::Class, 'logout'])->name('logout');


//untuk admin
//middleware() : memanggil middleware yang akan digunakan
//gruoup() : mengelompokan route agar mengikuti sifat sebelumnya

Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/dashboard', Function(){
        return view('admin.dashboard');
    })->name('dashboard');
    // Route::get('/users', Function(){
    //     return view('admin.user');
    // })->name('user');


    // data film
    Route::prefix('/cinemas')->name('cinemas.')->group(function(){
        //ambil banyak data : index
        Route::get('/', [CinemaController::class, 'index'])->name('index');
        //resource crate (function create controller) untuk memunculkan form tambah data
        Route::get('/create', [CinemaController::class, 'create'])->name('create');
        //resource store (function store controller) untuk mengirim data ke database. untuk proses form
        Route::post('/store', [CinemaController::class, 'store'])->name('store');
        // {id} -> parameter placeholder mengirim data ke controller, digunakan ketika akan mengambil data spesifik
        Route::get('/edit/{id}', [CinemaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CinemaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CinemaController::class, 'destroy'])->name('delete');
    });

    // data user
    Route::prefix('/users')->name('users.')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store',[UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    });

    // data film
    Route::prefix('/movies')->name('movies.')->group(function(){
        Route::get('/',[MovieController::class,'index'])->name('index');
        Route::get('/create',[MovieController::class,'create'])->name('create');
        Route::post('/store',[MovieController::class,'store'])->name('store');
        Route::get('/edit/{id}',[MovieController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[MovieController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[MovieController::class,'destroy'])->name('delete');
        Route::put('/toggle/{id}', [MovieController::class, 'toggle'])->name('toggle');
    });
});


// beranda
Route::get('/', [MovieController::class, 'home'])->name('home');
Route::get('/movies/actived', [MovieController::class, 'homeMovies'])->name('actived');
// detail film
Route::get('/detail/{id}', [MovieController::class, 'detail'])->name('detail');

