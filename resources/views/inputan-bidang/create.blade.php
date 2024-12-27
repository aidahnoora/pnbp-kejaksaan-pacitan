@extends('layouts.main')

@section('title', 'Inputan Bidang')

@section('css')

@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 offset-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Inputan Bidang</h4>
                        <form action="{{ route('inputan-tambah') }}" method="POST">
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
                                <label>Bidang</label>
                                <select class="form-control form-control-sm" id="bidang_id" name="bidang_id">
                                    <option value="" selected disabled>Pilih Bidang</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id_bidang }}" {{ old('id_inputan_bidang') == $bidang->id_bidang ? 'selected':'' }}>{{ $bidang->nama_bidang }} ({{ $bidang->alias }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>NTPN</label>
                                <input type="text" class="form-control form-control-sm" name="ntpn" placeholder="Masukkan NTPN" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control form-control-sm" name="jumlah" value="0" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Setor</label>
                                <input type="date" class="form-control form-control-sm" name="tgl_setor" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian</label>
                                <textarea name="uraian" class="form-control form-control-sm" cols="30" rows="3" required></textarea>
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
