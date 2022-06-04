@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-xl-8 col-md-5 mx-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Edit Kategori Berita</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/crud/kategori/{{ $kategori->id }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Metode</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nama Kategori" value="{{ old('name', $kategori->name) }}">
                        @error('name')
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