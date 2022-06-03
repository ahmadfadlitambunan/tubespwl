@extends('layouts.main')


@section('container')
<div class="row">
    <div class="col-lg-5">

        @if (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h3>Ubah Password</h3>
                <form action="{{ route('siswa.updatePass') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="oldPass">Password Saat ini</label>
                        <input type="password" class="form-control @error('oldPass') is-invalid @enderror" id="oldPass" name="oldPass" placeholder="Password saat ini" value="{{ old('oldPass') }}">
                        @error('oldPass')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="newPass">Password Baru</label>
                        <input type="password" class="form-control @error('newPass') is-invalid @enderror" id="newPass" name="newPass" placeholder="Password Baru" value="{{ old('newPass') }}">
                        @error('newPass')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="newPass_confirmation">Password Baru</label>
                        <input type="password" class="form-control @error('newPass_confirmation') is-invalid @enderror" id="newPass_confirmation" name="newPass_confirmation" placeholder="Konfirmasi Password" value="{{ old('newPass_confirmation') }}">
                        @error('newPass_confirmation')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection