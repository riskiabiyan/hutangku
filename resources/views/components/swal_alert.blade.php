@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('akun_dibuat'))
<script>
    Swal.fire({
        title: 'Akun berhasil dibuat',
        text: 'Silahkan login',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('ditolak'))
<script>
    Swal.fire({
        title: 'Akses dilarang',
        text: 'Silahkan login dahulu',
        icon: 'warning'
    });
</script>
@endif

@if (session()->has('penghutang_ditambahkan'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Data penghutang ditambahkan',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('hutang_masuk_berhasil'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Data hutang ditambahkan',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('hutang_disimpan'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Hutang berhasil disimpan',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('hutang_dibayar'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Hutang berhasil dibayarkan',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('hutang_diubah'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Hutang berhasil diubah',
        icon: 'success'
    });
</script>
@endif