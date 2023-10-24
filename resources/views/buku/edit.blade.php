@extends('buku.layout')

@section('title', 'Perpustakaan - Edit Buku')
    
@section('content')
    <div class="container">
        <h4>Edit Buku</h4>
        <form action="{{route('buku.update',$buku->id)}}" method="POST" >
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label  class="form-label">Judul</label>
                <input class="form-control" type="text" name="judul" id="judul" value="{{$buku->judul}}">
            </div>
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
            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
            <a class="btn btn-danger" href="/buku"> Batal</a>   
            </div>
        </form>
    </div>  
@endsection
