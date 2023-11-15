@extends('buku.layout')

@section('title', 'Perpustakaan - Edit Buku')
    
@section('content')
    <div class="container">
        <h4>Edit Buku</h4>
        <form action="{{route('buku.update',$buku->id)}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label  class="form-label">Judul</label>
                <input class="form-control" type="text" name="judul" id="judul" value="{{$buku->judul}}">
            </div>
            <div class="mb-3">
                <label for="thumbnail"  class="form-label">Cover</label>
                <input class="form-control" type="file" name="thumbnail" id="thumbnail" value="{{$buku->filepath}}" >
            </div>
            @if ($buku->filepath)
            <div class="relative h-10 w-10">
                <img src="{{asset($buku->filepath)}}"  class="h-full w-full rounded-full object-cover object-center" alt="">

            </div>
                
            @endif
            <div class="mb-3">
                <label  class="form-label">Penulis</label>
                <input class="form-control" type="text" name="penulis" id="penulis" value="{{$buku->penulis}}">
            </div>
            <div class="mb-3">
                <label  class="form-label">Harga</label>
                <input class="form-control" type="text" name="harga" id="harga" value="{{$buku->harga}}">
            </div>
            <div class="mb-3">
                <label  class="form-label">Date</label>
                <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit" value="{{$buku->tgl_terbit}}">
            </div>
            <div class="mb-3">
                <label for="galeri" class="form-label">Tambah Galeri</label>
                <input type="file" class="form-control" name="galeri[]" id="galeri" multiple>
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
            <a class="btn btn-danger" href="/buku"> Batal</a>   
            </div>
        </form>
        <div class="mb-3">
            @if ($buku->gallery()->count() > 0)
                <br><p class="h5 text-body-secondary">Galeri:</p>
            @endif
            @foreach ($buku->gallery()->get() as $item)
                <div class='mb-3'>
                    <img class='object-cover object-center'
                        src='{{ $item->path }}' alt='Gambar...' width="320">
                    <form action="{{ route('buku.delete_galeri', $item->id) }}" method="POST">
                        @csrf
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus Gambar</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>  
@endsection
