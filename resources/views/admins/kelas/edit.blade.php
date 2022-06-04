@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-xl-8 col-md-5 mx-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Edit Kelas</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/crud/kelas/{{ $kelas->id }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Kelas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nama Kelas" value="{{ old('name', $kelas->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6>Pilih Daftar Guru:</h6>
                            @foreach ($users as $guru)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{ old('user_id', $guru->id) }}"
                                    id="user_id{{ $loop->iteration }}" name="user_id">
                                <label class="form-check-label" for="user_id{{ $loop->iteration }}">{{ $guru->name
                                    }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection