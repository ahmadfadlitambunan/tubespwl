@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-8 col-md-5 mx-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Buat Jenis Pembayaran Baru</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('guru.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Pembayaran</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nama Pembayaran" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="a_n">A.N</label>
                        <input type="text" class="form-control @error('a_n') is-invalid @enderror" id="a_n" name="a_n"
                            placeholder="Atas Nama" value="{{ old('a_n') }}">
                        @error('a_n')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="account_no">Nomor Rekening</label>
                        <input type="text" class="form-control @error('account_no') is-invalid @enderror"
                            id="account_no" name="account_no" placeholder="Nomor Rekening / Nomor akun"
                            value="{{ old('account_no') }}">
                        @error('account_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection