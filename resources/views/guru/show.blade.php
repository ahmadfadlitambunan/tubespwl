@extends('layouts.main')


@section('container')
    <div class="row">
        <div class="col-xl-10 col-md-10 mx-4 ">

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
                    <h6 class="mr-auto font-weight-bold text-primary">Daftar Siswa :
                    @foreach($classes as $class) {{$class->name}}@endforeach
                    </h6>
                    <a href="{{ route('exportSiswaKls') }}" class="btn btn-success mx-2">Export</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-bordered' id="myTable">
                            <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->nis }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <a href="/guru/input/{{$student->nis}}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-plus-circle"></i> Tambah Tabungan
                                        </a>
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
