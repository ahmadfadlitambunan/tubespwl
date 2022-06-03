@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-8 col-md-5 mx-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Edit Guru</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/crud/guru/{{ $guru->id }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nama Guru" value="{{ old('name', $guru->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nip">No Pegawai</label>
                        <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip"
                            placeholder="No Pegawai Guru" value="{{ old('nip', $guru->nip) }}">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Email Guru" value="{{ old('email', $guru->email) }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_no">Nomor Telepon</label>
                        <input type="number" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no"
                            name="phone_no" placeholder="Nomor Telepon Guru"
                            value="{{ old('phone_no', $guru->phone_no) }}">
                        @error('phone_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Password Guru" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" value="guru" name="level">
                    <button type="submit" class="btn btn-primary mt-3">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection