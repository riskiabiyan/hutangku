@extends('home.master')

@section('title', 'Lihat hutang')

@section('content')
<h2 class="mb-4">Data Hutang</h2>
@if($hutang->isEmpty())
    <p>Tidak ada laporan untuk ditampilkan.</p>
@else

<table class="table">
    <thead >
        <tr class="bg-primary text-light">
            <th>Nama penghutang</th>
            <th>Jumlah hutang</th>
            <th>Tgl jatuh tempo</th>
            <th>Status hutang</th>
            <th>
                Opsi
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hutang as $item)
            <tr>
                <td>{{ $item->penghutang->nama_penghutang }}</td>
                <td>Rp. {{ $item->jumlah_hutang }}</td>
                <td>{{ $item->tgl_jatuh_tempo }}</td>
                <td>{{ $item->status_hutang }}</td>
                <td>
                    <a href="{{ route('form_ubah_hutang', ['penghutang_id' => $item->penghutang_id, 'id' => $item->id]) }}" class="btn btn-success">Ubah</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection