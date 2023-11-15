<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset('simplelineicons/css/simple-line-icons.css') }}>
    <title>Document</title>
</head>
<body>
    <div class="container mt-10">
        <form action="{{route('buku.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label  class="form-label">Judul</label>
                <input class="form-control" type="text" name="judul" id="judul" value="{{old ('judul')}}">
                @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label">Penulis</label>
                <input class="form-control" type="text" name="penulis" id="penulis"  value="{{old('penulis')}}">
                @error('penulis')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label">Harga</label>
                <input class="form-control" type="text" name="harga" id="harga" value="{{ old('harga') }}" >
                @error('harga')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-3">
                <label  class="form-label" >Date</label>
                <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit" value="{{ old('tgl_terbit') }}">
                @error('tgl_terbit')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Gambar Thumbnail</label>
                <input type="file" class="form-control" name="thumbnail" id="thumbnail" value="{{old('thumbnail')}}>
            </div>

            <div class="mb-3">
                <label for="galeri" class="form-label">Galeri</label>
                <input type="file" class="form-control" name="galeri[]" id="galeri" multiple>
            </div>
            <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-danger" href="/buku"> Batal</a>   
            </div>
</body>

{{--
@if ($errors !== null && count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>            
        @endforeach
    </ul>
@endif    
--}}
</html>
</x-app-layout>