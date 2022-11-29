@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Post') }}</div>

                <div class="card-body">
                    <h3>{{ $post->judul }}</h3>
                    <small>Penulis : {{ $post->user->name }}</small>
                    <p>{{ $post->isi }}</p>
                    <small>Tanggal : {{ $post->tanggal }}</small>
                </div>
                <div class="card-footer">
                    <h3>Rekomendasi Produk :</h3>
                    @foreach ($datas as $data)
                    <div class="card m-3" style="width: 18rem;">
                        <img src="{{ asset('storage/'. $data->foto) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $data->name }}</h5>
                            <p class="card-text">{{ 'Kategori : '.$data->kategori->name }}</p>
                            <p class="card-text">{{ 'Penulis : '.$data->user->name }}</p>
                            <a href="{{ url('produk/detail/'.$data->id) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
