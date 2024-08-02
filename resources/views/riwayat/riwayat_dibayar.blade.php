@extends('home.master')

@section('title', 'Riwayat dibayar')

@section('content')
<h2 class="mb-4">Data Hutang dibayar</h2>
@if($hutang_dibayar->isEmpty())
    <p>Tidak ada data untuk ditampilkan.</p>
@else

<table class="table">
    <thead >
        <tr class="bg-primary text-light">
            <th>Nama penghutang</th>
            <th>Keterangan</th>
            <th>Jumlah dibayar</th>
            <th>Waktu pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hutang_dibayar as $item)
            <tr>
                <td>{{ $item->penghutang->nama_penghutang }}</td>
                <td>Rp. {{ $item->keterangan }}</td>
                <td>{{ $item->jumlah_dibayar }}</td>
                <td>{{ $item->created_at }}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection