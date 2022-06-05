@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-xl-12 col-md-10 mx-1 ">
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
                    <h6 class="mr-auto font-weight-bold text-primary">Perlu Verifikasi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class = 'table table-bordered' id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Deposit</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savings as $saving)      
                                <tr>
                                     <td>{{ $loop->iteration }}</td>
                                     <td>{{ $saving->student->name }}</td>
                                     <td>{{ $saving->deposit }}</td>
                                     <td>{{ $saving->payment->name }}</td>
                                     <td><a href="{{ asset('storage/' . $saving->image) }}">Klik untuk melihat</a></td>
                                     <td>{{ $saving->created_at }}</td>
                                     <td>
                                        <form action="{{ route('saving.verify', ['saving' => $saving->id]) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="submit" name="status" class="btn btn-success" onclick="return confirm('Apakah anda yakin?')" value="pass">
                                            <input type="submit" name="status" class="btn btn-danger" onclick="return confirm('Apakah anda yakin')" value="fail">
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