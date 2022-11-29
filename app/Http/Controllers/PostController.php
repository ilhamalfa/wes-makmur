<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendeklarasikan variabel
        $datas = Post::all();
        $datas1 = Kategori::all();

        return view('admin.post.table', [
            'posts' => $datas,
            'kategoris' => $datas1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validate = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required'
        ]);

        $validate['tanggal'] = Carbon::now();
        $validate['user_id'] = auth()->user()->id;

        // Menginputkan data
        Post::create($validate);
        
        return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori_id' => 'required'
        ]);

        $validate['tanggal'] = Carbon::now();
        $validate['user_id'] = auth()->user()->id;

    // Mengupdate data
        $post->update($validate);
        
        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Menghapus data
        $post->delete();
        
        return redirect('post');
    }
    
    public function tampil($id){
        $data = Post::find($id);
        
        $data->update([
            'is_tampil' => 1
        ]);

        return redirect('post');
    }

    public function sembunyi($id){
        $data = Post::find($id);
        
        $data->update([
            'is_tampil' => 0
        ]);

        return redirect('post');
    }
}
