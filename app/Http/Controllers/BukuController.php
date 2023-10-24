<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $data_buku = Buku::orderBy("id", "desc")->paginate(10);
        $jumlah_buku = Buku::count();
        $total = Buku::sum('harga');
        $no = 10 * ($data_buku->currentPage() - 1);
        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total', 'no'));
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku');
    }

    public function edit($id)
    {
        if (request()->isMethod('post')) {
            $buku = Buku::find($id);
            return view('buku.edit', compact('buku'));
        } else {
            $buku = Buku::find($id);
            return view('buku.edit', compact('buku'));
        }
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect()->route('buku.index');
    }

    public function create()
    {
        return view('buku.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect()->route('buku.index')->with('pesan', 'Data Buku Berhasil Disimpan');
    }

    public function search(Request $request)
    {
        // Your search logic here
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'LIKE', '%' . $cari . '%')->orwhere('penulis', 'LIKE', '%' . $cari . '%')->paginate(10);
        $jumlah_buku = $data_buku->count();
        $no = 10 * ($data_buku->currentPage() - 1);
        return view('buku.search', compact('data_buku', 'jumlah_buku', 'cari', 'no'));
    }




}