<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset('simplelineicons/css/simple-line-icons.css') }}>
    <title>Index Buku</title>
</head>

<body>
    <div class="d-flex flex-wrap mb-3 position-relative " style="height: 40px">
        <a class="m-3 btn btn-success position-absolute top-0 end-0 icon-plus" href="{{ route('buku.create') }}" method="get"></a>
    </div>
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
                <td class="d-flex flex-row gap-1">
                    <form class="" action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf
                        <button class="btn btn-danger icon-trash"
                            onclick="return confirm('yakin mau dihapus?')"></button>
                    </form>
                    <form action="{{ route('buku.edit', $buku->id) }}" method="post">
                        @csrf
                        <button class="btn btn-primary icon-pencil"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-center">Jumlah buku : {{$jumlah_buku}}</p>
    <p class="text-center">Total harga buku : {{"Rp ".number_format($total, 2, ',','.')}}</p>

</body>

</html>