@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-12 col-md-12 ">

        @if (session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card shadow mb-8">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Daftar Wali Kelas / Guru</h6>
                <a href="{{ route('guru.create') }}" class="btn btn-primary mx-2">Buat Guru / Wali Kelas Baru</a>
                <a href="{{ route('guru.export') }}" class="btn btn-success">Export</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered' id="myTable">
                        <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Gender</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @foreach ($teachers as $guru)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guru->nip }}</td>
                                <td>{{ $guru->name }}</td>
                                <td>{{ $guru->email }}</td>
                                <td>{{ $guru->phone_no }}</td>
                                <td>{{ $guru->gender }}</td>
                                <td>
                                    <a href="/admin/crud/guru/{{ $guru->id }}/edit" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>

                                    <form action="/admin/crud/guru/{{ $guru->id }}" method="POST" class="d-inline">
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