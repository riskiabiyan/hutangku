@extends('home.master')

@section('title', 'Ubah hutang')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card p-4">
            <h2 class="text-center mb-4">Edit data hutang</h2>
            <form action="/update_hutang" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="penghutang_id" value="{{$penghutangID}}">
                <input type="hidden" name="id" value="{{$hutangID}}">
                <div class="form-group">
                    <label for="nama_penghutang">Nama penghutang</label>
                    <input type="text" class="form-control" name="nama_penghutang" value="{{$penghutang}}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_hutang">Jumlah hutang</label>
                    <input type="number" class="form-control" name="jumlah_hutang" value={{$jml_hutang}} required>
                </div>
                <div class="form-group">
                    <label for="tgl_jatuh_tempo">Tanggal Jatuh Tempo</label>
                    <input type="datetime-local" class="form-control" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" value="{{ \Carbon\Carbon::parse($jatuh_tempo)->format('Y-m-d\TH:i') }}">
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Ubah</button>
            </form>
        </div>
    </div>
</div>
    
@endsection