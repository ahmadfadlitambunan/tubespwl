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

        <div class="card shadow mb-8">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Daftar Tabungan Siswa</h6>
                <div class="dropdown">
                    <button class="btn btn-outline-success" data-toggle="dropdown">Report<i class="fas fw fa-caret-down ml-2"></i></button>
                    <div class="dropdown-menu mt-2">
                        <a href="{{ route('tabungan.export.m') }}" class="dropdown-item">Report Bulanan</a>
                        <a href="{{ route('tabungan.export.d') }}" class="dropdown-item">Report Harian</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered' id="myTable">
                        <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Deposit</th>
                                {{-- <th>Nama Admin</th> --}}
                                <th>Jenis Pembayaran</th>
                                <th>Metode Tabungan</th>
                                {{-- <th>Gambar</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @foreach ($savings as $tabungan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tabungan->student->name}}</td>
                                <td>{{ $tabungan->deposit }}</td>
                                @if ($tabungan->payment)
                                    <td>{{ $tabungan->payment->name }}</td>
                                @else
                                    <td>{{ $tabungan->user->name }}</td>
                                @endif
                                <td>{{ $tabungan->method->name }}</td>
                                {{-- <td>{{ $tabungan->image }}</td> --}}
                                <td>
                                    <a href="/admin/crud/tabungan/{{ $tabungan->id }}/edit"
                                        class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                    <form action="/admin/crud/tabungan/{{ $tabungan->id }}" method="POST"
                                        class="d-inline">
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