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
                        <h4 class="card-title">Edit Bidang</h4>
                        <form action="{{ route('inputan-edit', $inputan->id_inputan_bidang) }}" method="POST">
                            @csrf
                            @method('PUT')

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
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id_bidang }}" {{ $inputan->bidang_id == $bidang->id_bidang ? 'selected':'' }}>{{ $bidang->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>NTPN</label>
                                <input type="text" class="form-control form-control-sm" name="ntpn" value="{{ $inputan->ntpn }}" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control form-control-sm" name="jumlah" value="{{ $inputan->jumlah }}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Setor</label>
                                <input type="date" class="form-control form-control-sm" name="tgl_setor" value="{{ $inputan->tgl_setor }}" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian</label>
                                <textarea name="uraian" class="form-control form-control-sm" cols="30" rows="3" required>{{ $inputan->uraian }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Perbarui
                                </button>
                                <a href="/inputan" class="btn btn-warning btn-sm">
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
