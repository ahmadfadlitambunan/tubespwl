@extends('layouts.main')

@section('container')

@if (session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img mb-4">
                    <img src="{{ asset('storage/' . $student->image) }}" alt=""/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-8">
                        <div class="profile-head">
                            <h5>
                                @if (Auth::guard("user")->user())
                                    {{ Auth::guard("user")->user()->name }}
                                @elseif((Auth::guard('student')->user()))
                                    {{ Auth::guard("student")->user()->name }}
                                @endif  
                            </h5>
                            <h6>
                                Role : <span class="badge bg-success text-light">
                                    @if (Auth::guard("user")->user())
                                        @if (Auth::guard("user")->user()->level === "guru")
                                            Guru
                                        @elseif (Auth::guard("user")->user()->level === "admin")
                                            Admin
                                        @endif
                                    @elseif((Auth::guard('student')->user()))
                                        Siswa  
                                    @endif                             
                                    </span>
                            </h6>
                            <h6 class="proile-rating fs-4">Kelas : <span>???</span></h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tabungan</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-md-2 ml-auto">
                        <div class="dropdown">
                            <button class="btn btn-primary" data-toggle="dropdown"><i class="icon fa-cog fa-fw fas"></i></button>
                            <div class="dropdown-menu mt-2">
                                <a href="{{ route('siswa.edit') }}" class="dropdown-item">Edit Profile</a>
                                <a href="{{ route('siswa.reset')}}" class="dropdown-item">Ubah Password</a>
                            </div>
                        </div>
                    </div>  

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>NIS</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $student->nis }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $student->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Jenis Kelamin</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    @if ($student->gender === 'female')
                                                    Perempuan
                                                    @elseif($student->gender === 'male')
                                                    Laki - laki
                                                    @else
                                                    -
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Jumlah Tabungan</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Rp 1000000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>           
</div>
@endsection