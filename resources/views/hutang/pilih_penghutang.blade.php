@extends('home.master')

@section('title', 'Bayar hutang')

@section('content')

<h2 class="mb-4">Pilih penghutang</h2>
    @if($penghutang->isEmpty())
        <p>Tidak ada penghutang untuk ditampilkan.</p>
    @else
    
    <table class="table">
        <thead >
            <tr class="bg-primary text-light">
                <th>Nama penghutang</th>
                <th>Alamat</th>
                <th>No. WA</th>
                <th>Jumlah hutang</th>
                <th>
                    Jatuh tempo
                </th>
                <th>
                    Opsi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penghutang as $item)
                <tr>
                    <td>{{ $item->nama_penghutang }}</td>
                    <td>{{ $item->alamat_penghutang }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>
                        Rp. 
                        @if($item->hutang->isNotEmpty())
                            {{ $item->hutang->first()->jumlah_hutang }}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        @if($item->hutang->isNotEmpty())
                            {{ $item->hutang->first()->tgl_jatuh_tempo }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{url('/form_bayar_hutang', ['penghutang_id' => $item->id])}}" class="btn btn-success">Bayar hutang</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

@endsection