<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        $jurnals = Jurnal::query()
            ->when($request->filled('tanggal'), function ($query) use ($request) {
                $query->whereDate('tanggal', $request->tanggal);
            })
            ->when($request->filled('jam'), function ($query) use ($request) {
                $jamInput = $request->jam;

                $query->whereTime('created_at', 'like', '%' .  $jamInput . '%');
            })
            ->when($request->filled('keperluan'), function ($query) use ($request) {
                $query->where('keperluan', $request->keperluan);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('judul_buku', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jurnals.index', compact('jurnals'));
    }

    public function create()
    {
        return view('jurnals.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'keperluan' => 'required',
            'judul_buku' => 'nullable',
        ]);

        Jurnal::create($validatedData);
        return redirect('/success')->with('success', 'Absen Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        return view('jurnals.show', compact('jurnal'));
    }

    public function edit($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        return view('jurnals.edit', compact('jurnal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'keperluan' => 'required',
            'judul_buku' => 'nullable',
        ]);

        $jurnal = Jurnal::findOrFail($id);
        $jurnal->update($request->all());
        return view('/successEdit')->with('success', 'Absen Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete();
        return view('/successDelete')->with('success', 'Absen Berhasil Dihapus');
    }
}
