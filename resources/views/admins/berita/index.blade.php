@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-12 col-md-12">

        @if (session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Daftar berita</h6>
                <a href="{{ route('berita.create') }}" class="btn btn-primary mr-2"><i class="fas fw fa-plus"></i></a>
                <a href="#" class="btn btn-success mx-2">Export</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered' id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Author</th>
                                <th>Kutipan</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->title}}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->excerpt }}</td>
                                <td><img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->judul }}" width="128px" height="72px"></td>
                                <td>
                                    <a href="/admin/crud/berita/{{ $post->slug }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                    <form action="{{ route('berita.destroy', ['beritum' => $post->slug]) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
