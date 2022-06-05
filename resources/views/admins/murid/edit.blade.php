@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-8 col-md-5 mx-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Edit Siswa</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/crud/murid/{{ $murid->id }}">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <h6>Pilih Daftar Kelas:</h6>
                        <div class="card">
                            <div class="card-body">
                                @foreach ($grades as $kelas)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        value="{{ old('grade_id', $kelas->id) }}" id="grade_id{{ $loop->iteration }}"
                                        name="grade_id">
                                    <label class="form-check-label" for="grade_id{{ $loop->iteration }}">{{ $kelas->name
                                        }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nama Murid" value="{{ old('name', $murid->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nis">No Siswa</label>
                        <input type="number" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis"
                            placeholder="No Induk Siswa" value="{{ old('nis', $murid->nis) }}">
                        @error('nis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <fieldset class="row mb-1">
                            <legend class="col-form-label col-sm-5 pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="female">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Password Siswa" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection