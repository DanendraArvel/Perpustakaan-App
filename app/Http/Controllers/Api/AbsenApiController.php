<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurnal;

class AbsenApiController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::all();
        return response()->json([
            'success' => true,
            'data' => $jurnals
        ], 200);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required',
            'keperluan' => 'required|string',
            'judul_buku' => 'nullable|string',
        ]);

        $jurnal = Jurnal::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $jurnal
        ], 200);
    }

    public function show($id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'success' => false,
                'message' => 'Absen not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jurnal
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'success' => false,
                'message' => 'Absen not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required',
            'keperluan' => 'required|string',
            'judul_buku' => 'nullable|string',
        ]);

        $jurnal->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $jurnal
        ], 200);
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::find($id);

        if (!$jurnal) {
            return response()->json([
                'success' => false,
                'message' => 'Absen not found'
            ], 404);
        }

        $jurnal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Absen deleted successfully'
        ], 200);
    }
}
