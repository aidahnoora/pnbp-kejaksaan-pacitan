<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\InputanBidang;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class InputanBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inputans = InputanBidang::latest()->get();

        return view('inputan-bidang.index', compact('inputans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidangs = Bidang::get();

        return view('inputan-bidang.create', compact('bidangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'bidang_id' => 'required',
                'ntpn' => 'required',
                'jumlah' => 'required',
                'tgl_setor' => 'required',
                'uraian' => 'required',
            ]);

            $bulan = Carbon::parse($request->input('tgl_setor'))->format('m');

            $recordExist = InputanBidang::where('ntpn', $request->ntpn)
                ->whereMonth('tgl_setor', $bulan)
                ->exists();

            if (!$recordExist) {
                InputanBidang::create([
                    'bidang_id' => $request->bidang_id,
                    'ntpn' => $request->ntpn,
                    'jumlah' => $request->jumlah,
                    'tgl_setor' => $request->tgl_setor,
                    'uraian' => $request->uraian,
                ]);

                return redirect('inputan')->with('success', 'Data berhasil ditambahkan!');
            } else {
                return redirect('inputan')->with('warning', 'NTPN di bulan ini sudah terdaftar!');
            }
        } catch (Exception $e) {
            return redirect('inputan')->with('error', $e->getMessage());
        }
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
        $inputan = InputanBidang::find($id);
        $bidangs = Bidang::get();

        return view('inputan-bidang.edit', compact('inputan', 'bidangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'bidang_id' => 'required',
                'ntpn' => 'required',
                'jumlah' => 'required',
                'tgl_setor' => 'required',
                'uraian' => 'required',
            ]);

            $post = InputanBidang::findorfail($id);

            $post_data = [
                'bidang_id' => $request->bidang_id,
                'ntpn' => $request->ntpn,
                'jumlah' => $request->jumlah,
                'tgl_setor' => $request->tgl_setor,
                'uraian' => $request->uraian,
            ];

            $post->update($post_data);

            return redirect('inputan')->with('success', 'Berhasil memperbarui data!');
        } catch (Exception $e) {
            return redirect('inputan')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inputan = InputanBidang::find($id);
        $inputan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
