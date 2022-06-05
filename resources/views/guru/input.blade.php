@extends('layouts.main')

@section('container')
@foreach($students as $student)
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
                                    {{ $student->name }}
                                </h5>
                                <h6>
                                    Role : <span class="badge bg-success text-light">Student</span>
                                </h6>
                                <h6 class="proile-rating fs-4"><span>@foreach($classess as $class){{$class->name}}@endforeach</span></h6>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                    </li>
                                </ul>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jumlah Tabungan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                @currency($sum_depo)
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form action="/guru/input/{{$student->nis}}" method="post">
                                            @method('patch')
                                            @csrf
                                            <div class="col-md-6">
                                                <label for="deposit">Input Tabungan</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="nis" value="{{$student->nis}}">
                                                <input type="number" class="form-control" id="deposit" name="deposit" value="{{old('deposit')}}">
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary" onclick="return confirm("Input sudah benar?")">Done</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endforeach
@endsection
