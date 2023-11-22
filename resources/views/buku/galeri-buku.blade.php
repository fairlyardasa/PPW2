



@extends('buku.layout')

@section('title', 'Perpustakaan - Galeri Buku')
    
@section('content')
<section id="album" class="py-1 text-center bg-light">
    <div class="container">
        <h2>Buku: {{ $bukus->judul }}</h2>
        <hr>
        <div class="row">
        @foreach ($galeris as $data)
        <div class="col-md-4">
        <a href='{{ $data->path }}' 
        data-lightbox="image-1" data-title="{{ $data->keterangan }}">
        <img src="{{ $data->path }}" style="width:100%; height:100%"></a>
        <p><h5>{{ $data->nama_galeri }}</h5></p>
        </div>
        @endforeach
    </div>
        <div>{{ $galeris->links() }}</div>
    </div>
</section>
@endsection
