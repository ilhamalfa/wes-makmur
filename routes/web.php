<?php

use App\Http\Controllers\JamuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $datas = Post::where('is_tampil', 1)->get();
    $datasp = Produk::where('is_tampil', 1)->get();

    return view('index', [
        'datas' => $datas,
        'datasp' => $datasp
    ]);
});

Route::get('post/detail/{id}', function ($id) {
    $data = Post::find($id);
    $datas = Produk::where('kategori_id', $data->kategori_id)->where('is_tampil', 1)->paginate(4);

    return view('detail-post', [
        'post' => $data,
        'datas' => $datas
    ]);
});

Route::get('produk/detail/{id}', function ($id) {
    $data = Produk::find($id);

    return view('detail-product', [
        'data' => $data,
    ]);
});

Route::get('/jamu', function () {
    return view('jamu');
});

Route::post('/jamu/input', [JamuController::class, 'jamu']);

Route::middleware(['auth'])->group(function () {
    Route::resource('kategori', KategoriController::class);

    Route::resource('post', PostController::class);

    Route::resource('produk', ProdukController::class);

});

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('post/tampil/{id}', [PostController::class, 'tampil']);

    Route::get('post/sembunyi/{id}', [PostController::class, 'sembunyi']);

    Route::get('produk/tampil/{id}', [ProdukController::class, 'tampil']);

    Route::get('produk/sembunyi/{id}', [ProdukController::class, 'sembunyi']);

    Route::get('user', [UserController::class, 'index']);

    Route::get('user/admin/{id}', [UserController::class, 'admin']);

    Route::get('user/editor/{id}', [UserController::class, 'editor']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
