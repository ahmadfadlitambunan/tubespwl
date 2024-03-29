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
                <h6 class="mr-auto font-weight-bold text-primary">Daftar Pembayaran</h6>
                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mx-2">Buat Pembayaran</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered' id="myTable">
                        <thead style="text-align: center">
                            <tr>
                                <th>No</th>
                                <th>Nama Pembayaran</th>
                                <th>A.N</th>
                                <th>Nomor Rekening / Nomor Akun</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @foreach ($payments as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembayaran->name }}</td>
                                <td>{{ $pembayaran->a_n }}</td>
                                <td>{{ $pembayaran->account_no }}</td>
                                <td>
                                    <a href="/admin/crud/pembayaran/{{ $pembayaran->id }}/edit"
                                        class="btn btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                    <form action="/admin/crud/pembayaran/{{ $pembayaran->id }}" method="POST"
                                        class="d-inline">
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
@endsection