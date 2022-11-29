@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Product') }}</div>
                
                <center><img src="{{ asset('storage/'. $data->foto) }}" class="card-img-top w-25" alt="..."></center>
                <div class="card-body text-center">
                    <h3>{{ $data->name }}</h3>
                    <small>Harga : @currency($data->harga)</small><br>
                    <small>Kategori : {{ $data->kategori->name }}</small><br>
                    <small>Penulis : {{ $data->user->name }}</small><br>
                    <p>{{ $data->desc }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
