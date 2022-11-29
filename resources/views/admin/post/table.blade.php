@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">post</div>
                <div class="card-body">
                    <!-- Button Trigger Modal Create -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Post
                    </button>

                    <!-- Modal Create-->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Post</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('post') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Judul Post</label>
                                                <input type="text" class="form-control" name="judul">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Isi Post</label>
                                                <input type="text" class="form-control" name="isi">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select class="form-select" name="kategori_id">
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Input</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col" style="width: 40%">Isi</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Penulis</th>
                                    @if (auth()->user()->role == 'admin')
                                    <th scope="col">Tampil</th>
                                    @endif
                                    <th scope="col" style="width: 25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $post->judul }}</td>
                                    <td>{{ $post->isi }}</td>
                                    <td>{{ $post->kategori->name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    @if (auth()->user()->role == 'admin')
                                        @if ($post->is_tampil == 1)
                                        <td class="text-primary fw-bold">Tampil</td>
                                        @else
                                        <td class="text-danger fw-bold">Tidak Tampil</td>
                                        @endif
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}">Edit</button>

                                        <!-- Modal Create-->
                                        <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post {{ $post->judul }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ url('post/'. $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Judul Post</label>
                                                                <input type="text" class="form-control" name="judul" value="{{ $post->judul }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Isi Post</label>
                                                                <input type="text" class="form-control" name="isi" value="{{ $post->isi }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <select class="form-select" name="kategori_id">
                                                                    @foreach ($kategoris as $kategori)
                                                                        <option value="{{ $kategori->id }}" @selected($post->kategori_id == $kategori->id)>{{ $kategori->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Input</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-danger" onclick="event.preventDefault();
                                        document.getElementById('delete-form{{ $post->id }}').submit();">Hapus</button>

                                        <form id="delete-form{{ $post->id }}" action="{{ url('post/'. $post->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>

                                        @if (auth()->user()->role == 'admin')
                                            @if ($post->is_tampil == 1)
                                                <a href="{{ url('post/sembunyi/'.$post->id) }}" class="btn btn-primary">Sembunyikan</a>
                                            @else
                                                <a href="{{ url('post/tampil/'.$post->id) }}" class="btn btn-primary">Tampilkan</a>
                                            @endif
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
