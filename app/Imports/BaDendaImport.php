<?php

namespace App\Imports;

use App\Models\BaDenda;
use App\Models\DetailBaDenda;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BaDendaImport implements ToModel, WithStartRow, WithMapping
{
    private $bulan;
    private $tahun;
    private $idBaDenda;
    private $rowAkhir = 190;
    private $rowCount = 0;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function startRow(): int
    {
        return 10;
    }

    public function map($row): array
    {
        if ($this->rowCount >= $this->rowAkhir) {
            return [];
        }

        $this->rowCount++;

        return [
            'nama_terpidana'        => $row[1],
            'no_registrasi_tilang'  => $row[2],
            'no_pembayaran'         => $row[3],
            'tgl_bayar'             => $row[4],
            'tgl_putusan'           => $row[5],
            'denda_putusan'         => $row[6],
            'biaya_perkara_putusan' => $row[7],
            'jumlah_denda_putusan'  => $row[6] + $row[7],
            'denda_disetor'         => $row[9],
            'biaya_perkara_disetor' => $row[10],
            'ntpn'                  => $row[11],
            'channel'               => $row[12],
        ];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (empty($row)) {
            return null;
        }

        return DB::transaction(function () use ($row) {

            if (!$this->idBaDenda) {
                $baDenda = BaDenda::create([
                    'bulan' => $this->bulan,
                    'tahun' => $this->tahun,
                ]);

                $this->idBaDenda = $baDenda->id_ba_denda;
            }

            return new DetailBaDenda([
                'ba_denda_id'           => $this->idBaDenda,
                'nama_terpidana'        => $row['nama_terpidana'],
                'no_registrasi_tilang'  => $row['no_registrasi_tilang'],
                'no_pembayaran'         => $row['no_pembayaran'],
                'tgl_bayar'             => $row['tgl_bayar'],
                'tgl_putusan'           => $row['tgl_putusan'],
                'denda_putusan'         => $row['denda_putusan'],
                'biaya_perkara_putusan' => $row['biaya_perkara_putusan'],
                'jumlah_denda_putusan'  => $row['jumlah_denda_putusan'],
                'denda_disetor'         => $row['denda_disetor'],
                'biaya_perkara_disetor' => $row['biaya_perkara_disetor'],
                'ntpn'                  => $row['ntpn'],
                'channel'               => $row['channel'],
            ]);
        });
    }
}
