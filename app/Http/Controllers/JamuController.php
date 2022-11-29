<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JamuController extends Controller
{
    public function jamu(Request $request){

        // Deklarasi Variabel
        $data['keluhan'] = $request->keluhan;
        // Menggunakan method hitung umur
        $data['umur'] = umur($request->tahun);

        // Pemanggilan Class
        $class = new saran($data['keluhan'], $data['umur']);

        // Menggunakan method pada class
        $data['jamu'] = $class->namaJamu();
        $data['saran'] =  $class->Saran();
        $data['khasiat'] =  $class->khasiat();

        // dd($data);
        return view('jamu', [
            'data' => $data
        ]);

    }
}

function umur($tahun){
    // Mengembalikan Nilai tahun sekarang - tahun inputan
    return date('Y') - $tahun;
}

class Jamu{
    // Constructor
    public function __construct($keluhan, $umur)
    {
        $this->keluhan = $keluhan;
        $this->umur = $umur;
    }

// Method nama jamu
    public function namaJamu(){
        if($this->keluhan == 'Keseleo' || $this->keluhan == 'Kurang Nafsu Makan'){
            return 'Beras Kencur';
        }else if($this->keluhan == 'Pegal-pegal'){
            return 'Kunyit Asam';
        }else if($this->keluhan == 'Darah Tinggi' || $this->keluhan == 'Gula Darah'){
            return 'Brotowali';
        }else if($this->keluhan == 'Kram Perut' || $this->keluhan == 'Masuk Angin'){
            return 'Temulawak';
        }
    }

    // Method khasiat
    public function khasiat(){
        if($this->namaJamu() == 'Beras Kencur'){
            return 'Menghilangkan pegal-pegal pada tubuh';
        }else if($this->namaJamu() == 'Kunyit Asam'){
            return 'Mengurangi Risiko Komplikasi Penyakit Jantung';
        }else if($this->namaJamu() == 'Brotowali'){
            return 'Mengobati Sakit Demam Alami';
        }else if($this->namaJamu() == 'Temulawak'){
            return 'Meningkatkan Daya Tahan Tubuh';
        }
    }
}

// Class turunan dari class jamu
class saran extends Jamu{
    // Method saran
    public function Saran(){
        // Deklarasi variabel
        $saran = '';

        // Pengecekan berapa kali konsumsi
        if($this->umur <= 10){
            $saran = 'Dikomsumsi 1x';
        }else{
            $saran = 'Dikomsumsi 2x';
        }

        // Pengecekan cara pemakaian
        if($this->namaJamu() == 'Beras Kencur' && $this->keluhan == 'Keseleo'){
            return  $saran . ', Dioleskan';
        }else{
            return  $saran . ', Dikonsumsi';
        }
    }
}