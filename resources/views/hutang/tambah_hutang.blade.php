@extends('home.master')

@section('title', 'Tambah Hutang')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card p-4">
                <h2 class="text-center">Tambah data hutang</h2>
                <form action="/hutang_masuk" method="POST" class="mt-custom">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Penghutang</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="penghutang_id">
                            @foreach ($penghutang as $item)
                                <option value="{{$item->id}}">{{$item->nama_penghutang}}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan hutang</label>
                        <input type="text" class="form-control" name="keterangan" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="nilai_hutang">Nilai hutang</label>
                        <input type="number" class="form-control" name="nilai_hutang" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan data</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection