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
                <h6 class="mr-auto font-weight-bold text-primary">Daftar Metode</h6>
                <a href="{{ route('metode.create') }}" class="btn btn-primary mx-2"><i class="fas fw fa-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered' id="myTable">
                        <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Dibuat Pada</th>
                                <th>Di Update Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @foreach ($methods as $metode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $metode->name }}</td>
                                <td>{{ $metode->created_at }}</td>
                                <td>{{ $metode->updated_at }}</td>
                                <td>
                                    <a href="/admin/crud/metode/{{ $metode->id }}/edit"
                                        class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <form action="/admin/crud/metode/{{ $metode->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Semua data yang berelasi dengan ini akan ikut terhapus, Anda Yakin?')"><i class="fa fa-trash"
                                                aria-hidden="true"></i>
                                        </button>
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