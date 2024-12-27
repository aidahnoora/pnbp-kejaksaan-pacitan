<!DOCTYPE html>
<html>

<head>
    <title>Laporan BA Denda</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid black;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Laporan BA Denda - Bulan: @if ($bulan)
                {{ $bulan }}
            @else
                -
                @endif, Tahun: @if ($tahun)
                    {{ $tahun }}
                @else
                    -
                @endif
        </h2>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Ntpn</th>
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
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dendaPutusan = 0;
                        $biayaPerkaraPutusan = 0;
                        $jumlahDendaPutusan = 0;
                        $dendaDisetor = 0;
                        $biayaPerkaraDisetor = 0;
                    @endphp
                    @foreach ($detailBaDenda as $detail)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}.</td>
                            <td class="text-center">{{ $detail->ntpn ?? null }}</td>
                            <td>{{ $detail->nama_terpidana ?? null }}</td>
                            <td class="text-center">{{ $detail->no_registrasi_tilang ?? null }}</td>
                            <td class="text-center">{{ $detail->no_pembayaran ?? null }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($detail->tgl_bayar)) ?? null }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($detail->tgl_putusan)) ?? null }}</td>
                            <td class="text-right">Rp. {{ number_format($detail->denda_putusan) ?? null }}</td>
                            <td class="text-right">Rp. {{ number_format($detail->biaya_perkara_putusan) ?? null }}</td>
                            <td class="text-right">Rp. {{ number_format($detail->jumlah_denda_putusan) ?? null }}</td>
                            <td class="text-right">Rp. {{ number_format($detail->denda_disetor) ?? null }}</td>
                            <td class="text-right">Rp. {{ number_format($detail->biaya_perkara_disetor) ?? null }}</td>
                        </tr>
                        @php
                            $dendaPutusan += $detail->denda_putusan;
                            $biayaPerkaraPutusan += $detail->biaya_perkara_putusan;
                            $jumlahDendaPutusan += $detail->jumlah_denda_putusan;
                            $dendaDisetor += $detail->denda_disetor;
                            $biayaPerkaraDisetor += $detail->biaya_perkara_disetor;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="7" class="text-center"><strong>Total</strong></td>
                        <td class="text-right">Rp. {{ number_format($dendaPutusan) }}</td>
                        <td class="text-right">Rp. {{ number_format($biayaPerkaraPutusan) }}</td>
                        <td class="text-right">Rp. {{ number_format($jumlahDendaPutusan) }}</td>
                        <td class="text-right">Rp. {{ number_format($dendaDisetor) }}</td>
                        <td class="text-right">Rp. {{ number_format($biayaPerkaraDisetor) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
