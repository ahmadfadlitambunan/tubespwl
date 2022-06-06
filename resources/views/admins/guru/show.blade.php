@extends('layouts.main')

@section('container')
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img mb-4">
                        <img src="{{ asset('storage/' . $guru->image) }}" alt=""/>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="profile-head">
                                <h5>
                                    {{ $guru->name }}
                                </h5>
                                <h6>
                                    Role : <span class="badge bg-success text-light">{{ $guru->level }}</span>
                                </h6>

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                    </li>
                                </ul>                              
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="/admin/crud/guru/{{ $guru->id }}/edit" class="btn btn-sm btn-warning"><i
                                class="fa fa-edit" aria-hidden="true"></i></a>

                            <form action="/admin/crud/guru/{{ $guru->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>NIP</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $guru->nip }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $guru->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                @if ($guru->gender === 'female')
                                                    Perempuan
                                                @elseif($guru->gender === 'male')
                                                    Laki - laki
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                {{ $guru->phone_no }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                {{ $guru->email }}
                                            </p>
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
