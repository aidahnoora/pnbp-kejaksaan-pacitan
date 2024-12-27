<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Exception;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangs = Bidang::latest()->get();

        return view('bidang.index', compact('bidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_bidang' => 'required',
                'alias' => 'required',
            ]);

            Bidang::create([
                'nama_bidang' => $request->nama_bidang,
                'alias' => $request->alias,
            ]);

            return redirect('bidang')->with('success', 'Data berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect('bidang')->with('error', $e->getMessage());
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
        $bidang = Bidang::findorfail($id);

        return view('bidang.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $this->validate($request, [
                'nama_bidang' => 'required',
                'alias' => 'required',
            ]);

            $post = Bidang::findorfail($id);

            $post_data = [
                'nama_bidang' => $request->nama_bidang,
                'alias' => $request->alias,
            ];

            $post->update($post_data);

            return redirect('bidang')->with('success', 'Berhasil memperbarui data!');
        } catch (Exception $e) {
            return redirect('bidang')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bidang = Bidang::find($id);
        $bidang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
