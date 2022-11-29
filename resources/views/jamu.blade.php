@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header">Rekomendasi Jamu</div>

                <div class="card-body">
                    <form action="{{ url('jamu/input') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Keluhan</label>
                            <select class="form-select" name="keluhan">
                                    <option value="Keseleo">Keseleo</option>
                                    <option value="Kurang Nafsu Makan">Kurang Nafsu Makan</option>
                                    <option value="Pegal-pegal">Pegal-pegal</option>
                                    <option value="Darah Tinggi">Darah Tinggi</option>
                                    <option value="Gula Darah">Gula Darah</option>
                                    <option value="Kram Perut">Kram Perut</option>
                                    <option value="Masuk Angin">Masuk Angin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun Lahir</label>
                            <input type="number" class="form-control" name="tahun">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>

        @isset($data)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rekomendasi Jamu</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama Jamu</th>
                            <td>{{ $data['jamu'] }}</td>
                        </tr>
                        <tr>
                            <th>Khasiat</th>
                            <td>{{ $data['khasiat'] }}</td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td>{{ $data['keluhan'] }}</td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td>{{ $data['umur'] . ' Tahun' }}</td>
                        </tr>
                        <tr>
                            <th>Saran Penggunaan</th>
                            <td>{{ $data['saran'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>
        @endisset
    </div>
</div>
@endsection
