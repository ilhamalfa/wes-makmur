@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <h3>Post : </h3>
        @foreach ($datas as $data)
        <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $data->judul }}</h5>
                <p class="card-text">{{ 'Kategori : '.$data->kategori->name }}</p>
                <p class="card-text">{{ 'Penulis : '.$data->user->name }}</p>
                <a href="{{ url('post/detail/'.$data->id) }}" class="btn btn-primary">Detail</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row justify-content-center mb-3">
        <h3>Product : </h3>
        @foreach ($datasp as $datap)
        <div class="card m-3" style="width: 18rem;">
            <img src="{{ asset('storage/'. $datap->foto) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $datap->name }}</h5>
                <p class="card-text">{{ 'Kategori : '.$datap->kategori->name }}</p>
                <p class="card-text">{{ 'Penulis : '.$datap->user->name }}</p>
                <a href="{{ url('produk/detail/'.$datap->id) }}" class="btn btn-primary">Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
