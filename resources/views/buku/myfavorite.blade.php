@extends('buku.layout')

@section('title', 'Buku Favoritku - Index Buku')
    
@section('content')

<div class="px-4">
    <table class="table table-striped table-bordered table-hover mt-4">
        <thead>
            <tr>
                @if (Auth::check() && Auth::user()-> role_id == 1)
                <th>id</th>
                @endif
                <th>Judul Buku</th>
                <th>Penulis</th>
                @if (Auth::check() && Auth::user()-> role_id == 1)
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($favorites as $favorite)
            <tr class="table-row" data-href="{{ route('galeri.buku', $favorite->buku->id) }}"  style="cursor: pointer;">
                @if (Auth::check() && Auth::user()-> role_id == 1)
                <td>{{$favorite->buku->id}}</td>
                @endif
                <td>{{$favorite->buku->judul}}</td>
                <td>{{$favorite->buku->penulis}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="text-center px-6" style="height: 80px;">
    {{$favorites->links('pagination::simple-bootstrap-4')}}
</div>
@endsection

@section('script')
<script type="text/javascript">
    // $('.date').datepicker(
    //     {
    //         format : 'yyyy/mm/dd',
    //         autoclose : 'true'
    //     }
    // )

    $(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>

@if (Session::has('pesan'))
<div class="alert alert-success">
    {{Session::get('pesan')}}
</div>
    
@endif
@endsection



