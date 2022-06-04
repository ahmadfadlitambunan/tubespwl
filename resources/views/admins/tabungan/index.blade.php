@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-16 col-md-16">
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
                <form method="GET" onsubmit="return confirm ('Download Pdf Daftar Posting?')" action="pdf.php?pdf=2">
                    <button type='submit' name='btnpost' class='btn btn-outline-primary'>Report</button>
                </form>
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
                                <th>Status</th>
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
                                <td>{{ $tabungan->payment->name }}</td>
                                <td>{{ $tabungan->method->name }}</td>
                                <td>{{ $tabungan->status }}</td>
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