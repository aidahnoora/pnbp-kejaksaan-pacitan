<?php

namespace App\Imports;

use App\Models\SetorDebet;
use App\Models\DetailSetorDebet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DetailSetorDebetImport implements ToModel, WithStartRow, WithChunkReading, WithBatchInserts, WithHeadingRow
{
    private $setor_debet_id;

    public function __construct($bulan_setor_debet, $tahun_setor_debet)
    {
        $setor_debet = SetorDebet::firstOrCreate(['bulan_setor_debet' => $bulan_setor_debet, 'tahun_setor_debet' => $tahun_setor_debet]);
        $this->setor_debet_id = $setor_debet->id_setor_debet;
    }

    public function startRow(): int
    {
        return 10;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $ntpn =  $row[13];
        $recordExists = DetailSetorDebet::where('ntpn', $ntpn)
            ->exists();
        if (empty($row[1]) && empty($row[2])) {
            return null;
        }
        if ($recordExists) {
            return null;
        }
        // Log::info("Row Data: " . json_encode($row));
        // Log::info("Value of Column 1 (no_pembayaran): " . ($row[3] ?? 'null'));

        return new DetailSetorDebet([
            'setor_debet_id'                => $this->setor_debet_id,
            'nama_terpidana'                => $row[1],
            'no_registrasi_tilang'          => $row[2],
            'no_pembayaran'                 => $row[3] ?? null,
            'tgl_penitipan'                 => isset($row[4]) ? date('Y-m-d', strtotime($row[4])) : null,
            'jumlah_titipan'                => $row[5] ?? null,
            'tgl_putusan'                   => isset($row[6]) ? date('Y-m-d', strtotime($row[6])) : null,
            'denda_putusan'                 => $row[7] ?? null,
            'biaya_perkara_putusan'         => $row[8] ?? null,
            'jumlah_denda_putusan'          => $row[9] ?? null,
            'kelebihan_kekurangan_bayar'    => $row[10] ?? null,
            'denda_disetor'                 => $row[11] ?? null,
            'biaya_perkara_disetor'         => isset($row[12]) && is_numeric($row[12]) ? (float)$row[12] : null,
            'ntpn'                          => $row[13] ?? null,
        ]);
    }


    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
