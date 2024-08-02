@extends('home.master')

@section('title', 'Tambah Penghutang')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card p-4 mt-custom">
            <h3 class="text-center mb-4">Tambah Data Penghutang</h3>
            <form action="/update_penghutang" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_penghutang">Nama penghutang</label>
                    <input type="text" class="form-control" name="nama_penghutang" autofocus>
                </div>
                <div class="form-group">
                    <label for="alamat_penghutang">Alamat penghutang</label>
                    <input type="text" class="form-control" name="alamat_penghutang">
                </div>
                <div class="form-group">
                    <label for="no_wa">Nomor Whatsapp</label>
                    <input type="number" class="form-control" name="no_wa">
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>

    
@endsection