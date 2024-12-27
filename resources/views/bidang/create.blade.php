@extends('layouts.main')

@section('title', 'Bidang')

@section('css')

@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 offset-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Bidang</h4>
                        <form action="{{ route('bidang-tambah') }}" method="POST">
                            @csrf

                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Oops!</strong> Kesalahan saat input data!
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="form-group">
                                <label>Nama Bidang</label>
                                <input type="text" class="form-control form-control-sm" name="nama_bidang" placeholder="Masukkan nama bidang" required>
                            </div>
                            <div class="form-group">
                                <label>Alias (Singkatan)</label>
                                <input type="text" class="form-control form-control-sm" name="alias" placeholder="Masukkan nama alias bidang" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Simpan
                                </button>
                                <a href="/bidang" class="btn btn-warning btn-sm">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
