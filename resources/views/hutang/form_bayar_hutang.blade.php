@extends('home.master')

@section('title', 'Form bayar hutang')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card p-4">
            <h2 class="text-center">Bayar hutang</h2>
            <form action="/bayar_hutang" method="POST" class="mt-custom">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Penghutang</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="penghutang_id">
                        <option value="{{$penghutang->id}}">{{$penghutang->nama_penghutang}}</option>
                    </select>
                  </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan hutang</label>
                    <input type="text" class="form-control" name="keterangan" autofocus required>
                </div>
                <div class="form-group">
                    <label for="jumlah_dibayar">Jumlah dibayar</label>
                    <input type="number" class="form-control" name="jumlah_dibayar" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan data</button>
            </form>
        </div>
    </div>
</div>
    
@endsection