<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendeklarasikan variabel
        $datas = Produk::all();
        $datas1 = Kategori::all();

        // Ke view table produk
        return view('admin.produk.table', [
            'produks' => $datas,
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
        // Memvalidasi Masukan
        $validate = $request->validate([
            'name' => 'required',
            'foto' => 'required|image|max:10000',
            'harga' => 'required|integer',
            'desc' => 'required',
            'kategori_id' => 'required'
        ]);

        // Mengupload foto
        $file = $request->file('foto')->store('produk/foto');

        // Mendeklarasikan inputan
        $validate['foto'] = $file;
        $validate['user_id'] = auth()->user()->id;

        // Menginputkan ke database
        Produk::create($validate);

        return redirect('produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        // Jika terdapat inputan foto baru
        if(isset($request->foto)){
            // validasi
            $validate = $request->validate([
                'name' => 'required',
                'foto' => 'required|image|max:10000',
                'harga' => 'required|integer',
                'desc' => 'required',
                'kategori_id' => 'required'
            ]);
            
            // Pengecekan untuk menghapus foto yang lama
            if(fileExists('storage/'.$request->oldfoto)){
                unlink('storage/'. $request->oldfoto);
            }

            $file = $request->file('foto')->store('produk/foto');
    
            $validate['foto'] = $file;
            $validate['user_id'] = auth()->user()->id;
    
            // Mengupdate produk
            $produk->update($validate);
        }else{
            $validate = $request->validate([
                'name' => 'required',
                'harga' => 'required|integer',
                'desc' => 'required',
                'kategori_id' => 'required'
            ]);

            $validate['user_id'] = auth()->user()->id;
    
            $produk->update($validate);
        }

        return redirect('produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        // menghapus foto
        unlink('storage/'. $produk->foto);
        
        // Menghapus data di database
        $produk->delete();
        return redirect('produk');
    }

    public function tampil($id){
        // Mencari produk yang akan diupdate
        $data = Produk::find($id);
        
        // Mengupdate produk
        $data->update([
            'is_tampil' => 1
        ]);

        return redirect('produk');
    }

    public function sembunyi($id){
        $data = Produk::find($id);
        
        $data->update([
            'is_tampil' => 0
        ]);

        return redirect('produk');
    }
}
