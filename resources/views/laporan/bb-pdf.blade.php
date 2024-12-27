<!DOCTYPE html>
<html>

<head>
    <title>Laporan Bidang BB</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid black; }

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
        <h2 class="text-center">Laporan Bidang BB - Bulan: @if ($bulan)
                {{ $bulan }}
            @else
                -
                @endif, Tahun: @if ($tahun)
                    {{ $tahun }}
                @else
                    -
                @endif
        </h2>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>NTPN</th>
                    <th>Tanggal Setor</th>
                    <th>Uraian</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalJumlah = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}.</td>
                        <td>{{ $item->ntpn }}</td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($item->tgl_setor)) }}</td>
                        <td>{{ $item->uraian }}</td>
                        <td class="text-right">Rp. {{ number_format($item->jumlah) }}</td>
                    </tr>
                    @php
                        $totalJumlah += $item->jumlah;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4" class="text-center"><strong>Total</strong></td>
                    <td class="text-right">Rp. {{ number_format($totalJumlah) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
