<?php

namespace App\Imports;

use App\Models\BaDenda;
use App\Models\DetailBaDenda;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DetailBaDendaImport implements ToModel, WithStartRow, WithChunkReading, WithBatchInserts, WithHeadingRow
{
    private $ba_denda_id;

    public function __construct($bulan, $tahun)
    {
        $ba_denda = BaDenda::firstOrCreate(['bulan_ba_denda' => $bulan, 'tahun_ba_denda' => $tahun]);
        $this->ba_denda_id = $ba_denda->id_ba_denda;
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
        $ntpn =  $row[11];
        $recordExists = DetailBaDenda::where('ntpn', $ntpn)->exists();
        if (empty($row[1]) && empty($row[2])) {
            return null; // Abaikan baris ini jika kolom penting kosong
        }
        if ($recordExists) {
            return null;
        }
        // Log::info("Row Data: " . json_encode($row));
        // Log::info("Value of Column 1 (nama_terpidana): " . ($row[1] ?? 'null'));

        return new DetailBaDenda([
            'ba_denda_id'           => $this->ba_denda_id,
            'nama_terpidana'        => $row[1],
            'no_registrasi_tilang'  => $row[2],
            'no_pembayaran'         => $row[3],
            'tgl_bayar'             => isset($row[4]) ? date('Y-m-d', strtotime($row[4])) : null,
            'tgl_putusan'           => isset($row[5]) ? date('Y-m-d', strtotime($row[5])) : null,
            'denda_putusan'         => isset($row[6]) && is_numeric($row[6]) ? (float)$row[6] : null,
            'biaya_perkara_putusan' => isset($row[7]) && is_numeric($row[7]) ? (float)$row[7] : null,
            'jumlah_denda_putusan'  => (isset($row[6]) && is_numeric($row[6]) && isset($row[7]) && is_numeric($row[7])) ? (float)$row[6] + (float)$row[7] : null,
            'denda_disetor'         => is_numeric($row[9]) ? (int)$row[9] : null,
            'biaya_perkara_disetor' => isset($row[10]) && is_numeric($row[10]) ? (float)$row[10] : null,
            'ntpn'                  => $row[11] ?? null,
            'channel'               => $row[12] ?? null,
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
