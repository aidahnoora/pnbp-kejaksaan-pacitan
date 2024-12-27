@extends('layouts.main')

@section('title', 'Dashboard')

@section('css')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}!</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col stretch-card transparent p-0 m-1">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4 text-center" style="font-size: 20px"><br><strong>Pidana Khusus</strong></p>
                    <p class="text-center" style="font-size: 18px">
                        Piutang yang berasal dari Uang Pengganti Perkara Tindak Pidana Korupsi yang diputus berdasarkan UU No. 31/1999
                    </p> <br><br>
                </div>
            </div>
        </div>
        <div class="col stretch-card transparent p-0 m-1">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4 text-center" style="font-size: 20px"><br><strong>Perdata dan TUN</strong></p>
                    <p class="text-center" style="font-size: 18px">
                        Piutang yang berasal dari Uang Pengganti Perkara Tindak Pidana Korupsi yang diputus berdasarkan UU No. 3/1971
                    </p> <br><br>
                </div>
            </div>
        </div>
        <div class="col stretch-card transparent p-0 m-1">
            <div class="card card-light-blue">
                <div class="card-body">
                    <p class="mb-4 text-center" style="font-size: 20px"><br><strong>Denda Tilang</strong></p>
                    <p class="text-center" style="font-size: 18px">
                        Piutang yang berasal dari Denda dan Biaya Perkara Tilang. Terintegrasi dengan aplikasi E-Tilang Kejaksaan
                    </p> <br><br>
                </div>
            </div>
        </div>
        <div class="col stretch-card transparent p-0 m-1">
            <div class="card card-light-danger">
                <div class="card-body">
                    <p class="mb-4 text-center" style="font-size: 20px"><br><strong>TP-TGR</strong></p>
                    <p class="text-center" style="font-size: 18px">
                        Piutang yang berasal dari Tuntutan Perbendaharaan dan Tuntutan Ganti Rugi
                    </p> <br><br>
                </div>
            </div>
        </div>
        <div class="col stretch-card transparent p-0 m-1">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4 text-center" style="font-size: 20px"><br><strong>Sewa BMN</strong></p>
                    <p class="text-center" style="font-size: 18px">
                        Piutang yang berasal dari sewa Barang Milik Negara
                    </p> <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
