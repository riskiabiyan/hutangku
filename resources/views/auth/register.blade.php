@extends('auth.master_auth')

@section('title', 'Daftar')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="card p-4">
            <h3 class="text-center mb-4">Selamat datang</h3>
            <form action="/simpan_user" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" autofocus>
                </div>
                <div class="form-group">
                    <label for="no_hp">Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_hp" autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">Daftar</button>
                <p class="text-center mt-4">Sudah punya akun?  
                    <a href="{{url('/login')}}">Masuk</a>
                </p>
            </form>
        </div>
    </div>
</div>
    
@endsection