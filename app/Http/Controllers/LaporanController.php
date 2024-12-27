<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\InputanBidang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexPidum(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'pidum');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        return view('laporan.pidum', compact('data', 'bulan', 'tahun'));
    }

    public function exportPdfPidum(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'pidum');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        $pdf = Pdf::loadView('laporan.pidum-pdf', compact('data', 'bulan', 'tahun'));

        return $pdf->download("laporan_pidum_{$bulan}_{$tahun}.pdf");
    }

    public function indexPidsus(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'pidsus');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        return view('laporan.pidsus', compact('data', 'bulan', 'tahun'));
    }

    public function exportPdfPidsus(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'pidsus');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        $pdf = Pdf::loadView('laporan.pidsus-pdf', compact('data', 'bulan', 'tahun'));

        return $pdf->download("laporan_pidsus_{$bulan}_{$tahun}.pdf");
    }

    public function indexBb(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'bb');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        return view('laporan.bb', compact('data', 'bulan', 'tahun'));
    }

    public function exportPdfBb(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'bb');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        $pdf = Pdf::loadView('laporan.bb-pdf', compact('data', 'bulan', 'tahun'));

        return $pdf->download("laporan_bb_{$bulan}_{$tahun}.pdf");
    }

    public function indexPembinaan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'pembinaan');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        return view('laporan.pembinaan', compact('data', 'bulan', 'tahun'));
    }

    public function exportPdfPembinaan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $data = InputanBidang::whereHas('bidang', function ($query) {
            $query->where('alias', 'pembinaan');
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        $pdf = Pdf::loadView('laporan.pembinaan-pdf', compact('data', 'bulan', 'tahun'));

        return $pdf->download("laporan_pembinaan_{$bulan}_{$tahun}.pdf");
    }

    public function index(Request $request)
    {
        $bidangs = Bidang::all();

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $bidang = $request->input('bidang');

        $data = InputanBidang::whereHas('bidang', function ($query) use ($bidang) {
            if ($bidang) {
                $query->where('alias', $bidang);
            }
        })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        return view('laporan.index', compact('data', 'bidang', 'bulan', 'tahun', 'bidangs'));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $bidang = $request->input('bidang');

        $data = InputanBidang::whereHas('bidang', function ($query) use ($bidang) {
            if ($bidang) {
                $query->where('alias', $bidang);
            }
        })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tgl_setor', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tgl_setor', $tahun);
            })
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('data', 'bidang', 'bulan', 'tahun'));

        return $pdf->download("laporan_{$bidang}_{$bulan}_{$tahun}.pdf");
    }
}
