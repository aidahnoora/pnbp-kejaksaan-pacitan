@extends('layouts.main')

@section('title', 'Ba Denda')

@section('css')
<!-- Datepicker CSS -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ba Denda</h4>
                        <div>
                            <form action="{{ route('detail-ba-denda') }}" method="GET">
                                
                                <div class="row mb-3">
                                        <div class="col">
                                            <select name="bulan_ba_denda" id="bulan_denda" class="form-control form-control-sm" required>
                                                <option value="" selected disabled>Pilih Bulan</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="tahun_ba_denda" id="tahun_denda" placeholder="Pilih Tahun" class="form-control form-control-sm" required>
                                        </div>
                                   
                                    
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <a href="{{ route('detail-ba-denda.exportPdf', ['bulan_ba_denda' => $bulan ?? '', 'tahun_ba_denda' => $tahun ?? '']) }}"
                                                class="btn btn-success">Export PDF</a>
                                                <button class="btn btn-danger" id="delete_ba_denda">Delete</button>
                                        </div>
                                        
                                </div>   
                               
                            </form>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama Terpidana</th>
                                        <th>No Registrasi Tilang</th>
                                        <th>No Pembayaran</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Tanggal Putusan</th>
                                        <th>Denda Putusan</th>
                                        <th>Biaya Perkara Putusan</th>
                                        <th>Jumlah Denda Putusan</th>
                                        <th>Denda Disetor</th>
                                        <th>Biaya Perkara Disetor</th>
                                        <th>Ntpn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailBaDenda as $detail)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}.</td>
                                            <td>{{ $detail->nama_terpidana ?? null }}</td>
                                            <td class="text-center">{{ $detail->no_registrasi_tilang ?? null }}</td>
                                            <td class="text-center">{{ $detail->no_pembayaran ?? null }}</td>
                                            <td class="text-center">{{ date('d-m-Y',strtotime($detail->tgl_bayar)) ?? null }}</td>
                                            <td class="text-center">{{ date('d-m-Y',strtotime($detail->tgl_putusan)) ?? null }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->denda_putusan) ?? null }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->biaya_perkara_putusan) ?? null }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->jumlah_denda_putusan) ?? null }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->denda_disetor) ?? null }}</td>
                                            <td class="text-right">Rp. {{ number_format($detail->biaya_perkara_disetor) ?? null }}</td>
                                            <td class="text-right">{{ $detail->ntpn ?? null }}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tahun_denda').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
            });

            $('#data-table').DataTable();
        });
    </script>
    <script>
    $(document).ready(function () {
        $(document).on('click', '#delete_ba_denda', function (e) {
            e.preventDefault();
            let bulan = $('#bulan_denda').val();
            let tahun = $('#tahun_denda').val();
            let token = $("meta[name='csrf-token']").attr("content");

        if (!bulan || !tahun) {
            Swal.fire({
                icon: 'error',
                title: 'Input tidak lengkap',
                text: 'Harap isi bulan dan tahun sebelum menghapus data.',
            });
            return;
        }

        // Konfirmasi menggunakan SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus!',
                customClass: {
                    popup: 'custom-swal-height'
                }
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim AJAX request untuk delete
                $.ajax({
                    url: '/delete-ba-denda',
                    type: "DELETE",
                    data: {
                        bulan: bulan,
                        tahun: tahun,
                        _token: token
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message || 'Data berhasil dihapus!',
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan saat menghapus data.',
                            });
                        }
                    });
                }
            });
        });
    });

    </script>
@endsection
