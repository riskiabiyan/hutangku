@extends('home.master')

@section('title', 'Dashboard')

@section('content')

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Selamat datang {{Auth::user()->nama_lengkap}}!</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<div class="row ">
    <div class="col-lg-6">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Jumlah data hutang
              <span class="badge badge-primary badge-pill">{{$data_hutang}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Jumlah penghutang
              <span class="badge badge-primary badge-pill">{{$penghutang}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Jumlah nominal hutang
                <span class="badge badge-primary badge-pill">Rp. {{$nominal_hutang}}</span>
              </li>
          </ul>
    </div>
    <div class="col-lg-6">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Riwayat nominal hutang
              <span class="badge badge-primary badge-pill">
                Rp. {{$riwayat_hutang}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Riwayat nominal dibayar
              <span class="badge badge-primary badge-pill">Rp. {{$riwayat_dibayar}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Jatuh tempo otomatis dalam
                <span class="badge badge-primary badge-pill">30 hari</span>
            </li>
          </ul>
    </div>
</div>
    
@endsection