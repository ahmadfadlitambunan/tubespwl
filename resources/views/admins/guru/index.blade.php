@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-16 col-md-16 ">
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
                <a href="{{ route('guru.create') }}" class="btn btn-primary mx-2"><i class="fas fw fa-user-plus"></i></a>
                <div class="dropdown">
                    <button class="btn btn-outline-success" data-toggle="dropdown">Report<i class="fas fw fa-caret-down ml-2"></i></button>
                    <div class="dropdown-menu mt-2">
                        <a href="{{ route('guru.exportX') }}" class="dropdown-item">Export Xlsx</a>
                        <a href="{{ route('guru.exportC') }}" class="dropdown-item">Export Csv</a>
                    </div>
                </div>
                <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#importCsv">
                    importCsv
                </button>
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
                                    <a href="/admin/crud/guru/{{ $guru->id }}" class="btn btn-sm btn-success"><i
                                            class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="/admin/crud/guru/{{ $guru->id }}/edit" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>

                                    <form action="/admin/crud/guru/{{ $guru->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Semua data yang berelasi dengan ini akan ikut terhapus, Anda Yakin?')"><i class="fa fa-trash"
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

<!-- Modal Import Excel -->
<div class="modal fade" id="importCsv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data">
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