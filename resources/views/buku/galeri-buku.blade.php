@extends('buku.layout')

@section('title', 'Perpustakaan - Galeri Buku')
    
@section('content')

<div class="py-2 text-center bg-light">
    <form class="" action="{{route('myfavorite.store', $bukus->id)}}" method="POST">
        @csrf
        <input type="hidden" name="buku_id" value="{{ $bukus->id }}">
        <input type="hidden" name="id" value="{{ $bukus->id }}">
        <button class="btn btn-warning icon-star"> Simpan ke daftar favorit</button>
    </form>
</div>

<section id="album" class="py-1 text-center bg-light" >
    <div class="container" style="margin: 40px ; padding: 40px">
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
<section id="d-flex rating" style=" padding: 40px">
    <div>
        <label  class="form-label">Give a stars for this book : </label>

        @if (Auth::check())
        <form action="{{ route('rating.store',$bukus->id)}}" method="POST">
            @csrf
            <input type="hidden" name="buku_id" value="{{ $bukus->id }}">
            <input type="hidden" name="id" value="{{ $bukus->id }}">
            <div class="dropdown" >
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    ⭐
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><button class="dropdown-item" type="submit" name="rating" value="1">⭐</button></li>
                    <li><button class="dropdown-item" type="submit" name="rating" value="2">⭐⭐</button></li>
                    <li><button class="dropdown-item" type="submit" name="rating" value="3">⭐⭐⭐</button></li>
                    <li><button class="dropdown-item" type="submit" name="rating" value="4">⭐⭐⭐⭐</button></li>
                    <li><button class="dropdown-item" type="submit" name="rating" value="5">⭐⭐⭐⭐⭐</button></li>
                </ul>
            </div>
        </form>
        @endif
    </div>
    <div class="p-2">
        Average Rating : {{$averageRating}}
    </div>
</section>
@endsection
