<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallery;
use Intervention\Image\Facades\Image;


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

    public function update(Request $request, string $id)
    {


        $buku = Buku::find($id);
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // dd($request->file('thumbnail'));


        if ($request->hasFile('thumbnail')) {
            $filename = $request->file('thumbnail')->getClientOriginalName();
            $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');


            Image::make(storage_path() . '/app/public/uploads/' . $filename)
                ->fit(240, 320)
                ->save();

            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $filename,
                'filepath' => '/storage/' . $filepath
            ]);
        }


        if ($request->hasFile('galeri')) {
            if ($request->file('galeri')) {
                foreach ($request->file('galeri') as $key => $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
                    $galeri = Gallery::create([
                        'nama_galeri' => $fileName,
                        'path' => '/storage/' . $filePath,
                        'foto' => $fileName,
                        'buku_id' => $id,
                    ]);
                }
            }
        }
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

        // dd($request->file('thumbnail'));

        if ($request->hasFile('thumbnail')) {
            $request->validate([
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
            Image::make(storage_path() . '/app/public/uploads/' . $fileName)->fit(240, 320)->save();

            $buku = Buku::create([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath
            ]);
        }


        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $galeri = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'buku_id' => $buku->id
                ]);
            }
        }


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

    public function deleteGaleri(string $id)
    {
        $galeri = Gallery::find($id);
        $galeri->delete();
        return redirect()->back()->with('pesan', 'Gambar Galeri Berhasil Dihapus!');
    }




}