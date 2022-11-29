@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Produk</div>
                <div class="card-body">
                    <!-- Button Trigger Modal Create -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah produk
                    </button>

                    <!-- Modal Create-->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('produk') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama produk</label>
                                                <input type="text" class="form-control" name="name" >
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Foto produk</label>
                                                <input type="file" class="form-control" name="foto" >
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga produk</label>
                                                <input type="number" class="form-control" name="harga" min="0" >
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="desc">
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
                                    <th scope="col">Nama produk</th>
                                    <th scope="col" style="width: 15%">Foto</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Penulis</th>
                                    @if (auth()->user()->role == 'admin')
                                    <th scope="col">Tampil</th>
                                    @endif
                                    <th scope="col" style="width: 25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $produk->name }}</td>
                                    <td><img src="{{ asset('storage/'. $produk->foto) }}" alt="" class="img img-thumbnail"></td>
                                    <td>@currency($produk->harga)</td>
                                    <td>{{ $produk->desc }}</td>
                                    <td>{{ $produk->kategori->name }}</td>
                                    <td>{{ $produk->user->name }}</td>
                                    @if (auth()->user()->role == 'admin')
                                        @if ($produk->is_tampil == 1)
                                        <td class="text-primary fw-bold">Tampil</td>
                                        @else
                                        <td class="text-danger fw-bold">Tidak Tampil</td>
                                        @endif
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#editModal{{ $produk->id }}">Edit</button>

                                        <!-- Modal Create-->
                                        <div class="modal fade" id="editModal{{ $produk->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit produk {{ $produk->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ url('produk/'. $produk->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama produk</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $produk->name }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Foto produk</label>
                                                                <img src="{{ asset('storage/'. $produk->foto) }}" alt="" class="img img-thumbnail h-25">
                                                                <input type="file" class="form-control" name="foto">
                                                                <input type="hidden" class="form-control" name="oldfoto" value="{{ $produk->foto }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Harga produk</label>
                                                                <input type="number" class="form-control" name="harga" min="0" value="{{ $produk->harga }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Deskripsi</label>
                                                                <input type="text" class="form-control" name="desc" value="{{ $produk->desc }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <select class="form-select" name="kategori_id">
                                                                    @foreach ($kategoris as $kategori)
                                                                        <option value="{{ $kategori->id }}"  @selected($produk->kategori_id == $kategori->id)>{{ $kategori->name }}</option>
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
                                        document.getElementById('delete-form{{ $produk->id }}').submit();">Hapus</button>

                                        <form id="delete-form{{ $produk->id }}" action="{{ url('produk/'. $produk->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        
                                        @if (auth()->user()->role == 'admin')
                                            @if ($produk->is_tampil == 1)
                                                <a href="{{ url('produk/sembunyi/'.$produk->id) }}" class="btn btn-primary">Sembunyikan</a>
                                            @else
                                                <a href="{{ url('produk/tampil/'.$produk->id) }}" class="btn btn-primary">Tampilkan</a>
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
