<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DetailBaDendaImport;
use App\Imports\DetailSetorDebetImport;

class ImportController extends Controller
{
    /**
     * Display a import ba denda.
     */
    public function index()
    {
        return view('import.import');
    }
    /**
     * Display a import setor debet.
     */
    public function import_setor()
    {
        return view('import.import_setor');
    }
    /**
     * Store a import ba denda.
     */
    public function import(Request $request)
    {
        Excel::import(new DetailBaDendaImport($request->bulan_ba_denda, $request->tahun_ba_denda), $request->file('file'));
        return back();
    }
    /**
     * Store a import setor debet.
     */
    public function import_setor_debet(Request $request)
    {
        Excel::import(new DetailSetorDebetImport($request->bulan_setor_debet, $request->tahun_setor_debet), $request->file('fileSetor'));
        return back();
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
    public function destroy(string $id)
    {
        //
    }
}
