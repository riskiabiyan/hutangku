@extends('home.master')

@section('title', 'Data Penghutang')

@section('content')


    <h2 class="mb-4">Data penghutang</h2>
    @if($penghutang->isEmpty())
        <p>Tidak ada laporan untuk ditampilkan.</p>
    @else
    <a href="{{url('/tambah_penghutang')}}" class="btn btn-success mb-4">Tambah penghutang</a>
    <table class="table">
        <thead >
            <tr class="bg-primary text-light">
                <th>Nama penghutang</th>
                <th>Alamat</th>
                <th>No. WA</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($penghutang as $item)
                <tr>
                    <td>{{ $item->nama_penghutang }}</td>
                    <td>{{ $item->alamat_penghutang }}</td>
                    <td>{{ $item->no_wa }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection