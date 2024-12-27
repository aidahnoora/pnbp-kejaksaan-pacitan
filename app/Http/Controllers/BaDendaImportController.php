<?php

namespace App\Http\Controllers;

use App\Models\BaDenda;
use Illuminate\Http\Request;
use App\Models\DetailBaDenda;
use App\Imports\BaDendaImport;
use App\Imports\DetailBaDendaImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class BaDendaImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('import-ba-denda.create');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'bulan_ba_denda' => 'required',
            'tahun_ba_denda' => 'required',
        ]);

        $bulan = $request->bulan_ba_denda;
        $tahun = $request->tahun_ba_denda;

        Excel::import(new DetailBaDendaImport($bulan, $tahun), $request->file('file'));

        return back()->with('success', 'Import successfully!');
    }
    /**
     * Show the form for creating a new resource.
     */

    public function getBaDenda(Request $request)
    {
        $bulan = $request->input('bulan_ba_denda');
        $tahun = $request->input('tahun_ba_denda');

        $detailBaDenda = DetailBaDenda::whereHas('baDenda', function ($query) use ($bulan, $tahun) {
            $query->where('bulan_ba_denda', $bulan)
                ->where('tahun_ba_denda', $tahun);
        })->get();

        return view('ba-denda.index', compact('detailBaDenda', 'bulan', 'tahun'));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan_ba_denda');
        $tahun = $request->input('tahun_ba_denda');

        $detailBaDenda = DetailBaDenda::whereHas('baDenda', function ($query) use ($bulan, $tahun) {
            $query->where('bulan_ba_denda', $bulan)
                ->where('tahun_ba_denda', $tahun);
        })->get();

        $pdf = Pdf::loadView('ba-denda.pdf', compact('detailBaDenda', 'bulan', 'tahun'))
            ->setPaper('legal', 'landscape')
            ->setOptions(['margin-left' => 1, 'margin-right' => 1]);

        return $pdf->download("ba_denda_{$bulan}_{$tahun}.pdf");
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // $request->all();
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        try {
            // Logika untuk menghapus data
            // $data = BaDenda::where('bulan_ba_denda', $bulan)->orWhere('tahun_ba_denda', $tahun)->get();
            $data = DetailBaDenda::with('baDenda')
                ->whereHas('baDenda', function ($query) use ($bulan, $tahun) {
                    $query->where('bulan_ba_denda', $bulan)
                        ->orWhere('tahun_ba_denda', $tahun);
                })
                ->get();

            foreach ($data as $item) {
                $item->delete();
            }
            // DetailBaDenda::with('detailBaDenda')->where('')->get();
            // BaDenda::whereMonth('created_at', $bulan)
            //     ->whereYear('created_at', $tahun)
            //     ->delete();


            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }
}
