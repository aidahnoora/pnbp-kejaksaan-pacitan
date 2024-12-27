<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DetailSetorDebetImport;
use App\Models\DetailSetorDebet;
use Barryvdh\DomPDF\Facade\Pdf;

class SetorDebetImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('import-setor-debet.create');
    }

    public function import(Request $request)
    {
        $request->validate([
            'fileSetor' => 'required|mimes:xlsx',
            'bulan_setor_debet' => 'required',
            'tahun_setor_debet' => 'required',
        ]);
        Excel::import(new DetailSetorDebetImport($request->bulan_setor_debet, $request->tahun_setor_debet), $request->file('fileSetor'));
        return back()->with('success', 'Import successfully!');
    }

    public function getSetorDebet(Request $request)
    {
        $bulan = $request->input('bulan_setor_debet');
        $tahun = $request->input('tahun_setor_debet');

        $detailSetorDebet = DetailSetorDebet::whereHas('setorDebet', function ($query) use ($bulan, $tahun) {
            $query->where('bulan_setor_debet', $bulan)
                ->where('tahun_setor_debet', $tahun);
        })->get();

        return view('setor-debet.index', compact('detailSetorDebet', 'bulan', 'tahun'));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan_setor_debet');
        $tahun = $request->input('tahun_setor_debet');

        $detailSetorDebet = DetailSetorDebet::whereHas('setorDebet', function ($query) use ($bulan, $tahun) {
            $query->where('bulan_setor_debet', $bulan)
                ->where('tahun_setor_debet', $tahun);
        })->get();

        $pdf = Pdf::loadView('setor-debet.pdf', compact('detailSetorDebet', 'bulan', 'tahun'))
            ->setPaper('legal', 'landscape')
            ->setOptions(['margin-left' => 1, 'margin-right' => 1]);

        return $pdf->download("setor_debet_{$bulan}_{$tahun}.pdf");
    }

    /**
     * Show the form for creating a new resource.
     */
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
        // dd($request->all());
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        try {
            $data = DetailSetorDebet::with('setorDebet')
                ->whereHas('setorDebet', function ($query) use ($bulan, $tahun) {
                    $query->where('bulan_setor_debet', $bulan)
                        ->orWhere('tahun_setor_debet', $tahun);
                })
                ->get();

            foreach ($data as $item) {
                $item->delete();
            }
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }
}
