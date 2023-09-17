<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Index Buku</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tgl. Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $buku)
            <tr>
                <td>{{$buku -> id}}</td>
                <td>{{$buku -> judul}}</td>
                <td>{{$buku -> penulis}}</td>
                <td>{{"Rp ".number_format($buku->harga, 2, ',','.')}}</td>
                <td>{{\Carbon\carbon::parse($buku->tgl_terbit)->format('d/m/Y')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-center">Jumlah buku : {{$jumlah_buku}}</p>
    <p class="text-center">Total harga buku : {{"Rp ".number_format($total, 2, ',','.')}}</p>
</body>

</html>