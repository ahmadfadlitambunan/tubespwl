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
                    <a href="{{ route('admins.create') }}" class="btn btn-primary mr-2"><i class="fas fw fa-user-plus"></i></a>
                    <a href="{{ route('user.export') }}" class="btn btn-success mx-2">Export</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcel">
                        Import
                    </button>
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

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Pilih file yang ingin di-import!</label>
                                <input type="file" id="formFile" name="file">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
