@extends('layouts.main')

@section('title', 'Laporan Bidang Pidum')

@section('css')
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Bidang Pidum</h4>

                        <form action="{{ route('laporan.pidum') }}" method="GET">
                            <div class="row mb-3">
                                <div class="col">
                                    <select name="bulan" class="form-control form-control-sm" required>
                                        <option value="" selected disabled>Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="tahun" id="tahun" placeholder="Pilih Tahun"
                                        class="form-control form-control-sm" required>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('laporan.exportPdfPidum', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                                        class="btn btn-success">Export PDF</a>
                                </div>
                            </div>

                        </form>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="50">No.</th>
                                        <th>NTPN</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Setor</th>
                                        <th>Uraian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}.</td>
                                            <td>{{ $item->ntpn }}</td>
                                            <td class="text-right">Rp. {{ number_format($item->jumlah) }}</td>
                                            <td class="text-center">{{ $item->tgl_setor }}</td>
                                            <td>{{ $item->uraian }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tahun').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
            });

            $('#data-table').DataTable();
        });
    </script>
@endsection
