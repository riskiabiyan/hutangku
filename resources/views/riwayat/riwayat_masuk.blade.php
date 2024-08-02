@extends('home.master')

@section('title', 'Riwayat masuk')

@section('content')
<h2 class="mb-4">Data Hutang Masuk</h2>
@if($hutang_masuk->isEmpty())
    <p>Tidak ada data untuk ditampilkan.</p>
@else

<table class="table">
    <thead >
        <tr class="bg-primary text-light">
            <th>Nama penghutang</th>
            <th>Keterangan</th>
            <th>Nilai hutang</th>
            <th>Waktu ditambahkan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hutang_masuk as $item)
            <tr>
                <td>{{ $item->penghutang->nama_penghutang }}</td>
                <td>Rp. {{ $item->keterangan }}</td>
                <td>{{ $item->nilai_hutang }}</td>
                <td>{{ $item->created_at }}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection