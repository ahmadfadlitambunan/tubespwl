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
                <h6 class="mr-auto font-weight-bold text-primary">Daftar Riwayat Tabungan</h6>
                <form method="GET" onsubmit="return confirm ('Download Pdf Daftar Posting?')" action="pdf.php?pdf=2">
                    <button type='submit' name='btnpost' class='btn btn-outline-primary'>Report</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class='table table-bordered' id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Deposit</th>
                                {{-- <th>Nama Admin</th> --}}
                                <th>Pembayaran Melalui</th>
                                <th>Metode Tabungan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                {{-- <th>Gambar</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($savings as $tabungan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tabungan->deposit }}</td>
                                
                                @if ($tabungan->payment)
                                <td>{{ $tabungan->payment->name }}</td>
                                @else
                                <td>{{ $tabungan->user->name }}</td>
                                @endif
                                <td>{{ $tabungan->method->name }}</td>
                                <td>{{ $tabungan->status }}</td>
                                <td>{{ $tabungan->created_at }}</td>
                                {{-- <td>{{ $tabungan->image }}</td> --}}

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