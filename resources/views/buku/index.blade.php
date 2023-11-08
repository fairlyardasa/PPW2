@if (Auth::check() && Auth::user()-> role_id == 1)

@extends('buku.layout')

@section('title', 'Perpustakaan - Index Buku')
    
@section('content')
<div class="d-flex flex-wrap m-3 position-relative " style="height: 40px">
    <form class="d-flex flex-row gap-1" action="{{ route('buku.search') }}" method="get">
        @csrf
        <div>
            <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="float: right">
        </div>
        <div>
            <button type="submit" class="btn btn-primary icon-magnifier" style="height: 40px"></button>
        </div>
    </form>
</div>
<div class="d-flex flex-wrap m-3 position-relative " style="height: 40px">
    <input type="text" name="tgl_terbit" id="tgl_terbit"  class="date form-control w-40" placeholder="yyyy/mm/dd" data-provide="datepicker">
</div>
<div class="d-flex flex-wrap position-relative " style="height: 40px">
    <a class="m-3 btn btn-success position-absolute top-0 end-0 icon-plus" href="{{ route('buku.create') }}" method="get"></a>
</div>
<div class="px-4">
    <table class="table table-striped table-bordered mt-4">
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
                    <form class="" action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger icon-trash"
                            onclick="return confirm('yakin mau dihapus?')"></button>
                    </form>
                    <form action="{{ route('buku.edit', $buku->id) }}">
                        <button class="btn btn-primary icon-pencil"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="text-center px-6" style="height: 80px;">
    {{$data_buku->links('pagination::simple-bootstrap-4')}}
</div>
<p class="text-center">Jumlah buku : {{$jumlah_buku}}</p>
<p class="text-center">Total harga buku : {{"Rp ".number_format($total, 2, ',','.')}}</p>
@endsection

@section('script')
<script type="text/javascript">
    $('.date').datepicker(
        {
            format : 'yyyy/mm/dd',
            autoclose : 'true'
        }
    )
</script>

@if (Session::has('pesan'))
<div class="alert alert-success">
    {{Session::get('pesan')}}
</div>
    
@endif
@endsection


@endif