<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset('simplelineicons/css/simple-line-icons.css') }}>>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h4>Edit Buku</h4>
        <form action="{{route('buku.update',$buku->id)}}" method="POST">
            @csrf
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
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-danger" href="/buku"> Batal</a>   
            </div>
        </form>
    </div>  
</body>
</html>