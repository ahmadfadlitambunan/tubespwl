@extends('layouts.main')

@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800" style="text-align: center">Berita</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mb-3">
                <img src="https://source.unsplash.com/1200x400?" alt="" class="img-fluid mt-3">
                <div class="card-body">
                    <a href="/" class="text-decoration-none text-dark">
                        <h3 class="card-title">Judul</h3>
                    </a>
                    <p class="mb-3">
                        <small class="text-muted">
                            By : <a href="/" class="text-decoration-none">Ucok</a> in <a href="/"
                                class="text-decoration-none">Berita</a>
                        </small>
                    </p>

                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, deleniti.
                    </p>
                    <a href="/" class="text-decoration-none btn btn-primary">Read More</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                            <a href="/" class="text-decoration-none text-light">
                                Berita
                            </a>
                        </div>
                        <a href="/" class="text-decoration-none">
                            <img src="https://source.unsplash.com/400x200?" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">Lorem ipsum dolor sit.</h5>

                            <p>
                                <small class="text-muted">
                                    By : <a href="/" class="text-decoration-none">Ucok</a> Today
                                </small>
                            </p>

                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde, saepe!
                            </p>

                            <a href="/" class="text-decoration-none btn btn-primary btn-small">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                            <a href="/" class="text-decoration-none text-light">
                                Berita
                            </a>
                        </div>
                        <a href="/" class="text-decoration-none">
                            <img src="https://source.unsplash.com/400x200?" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">Lorem ipsum dolor sit.</h5>

                            <p>
                                <small class="text-muted">
                                    By : <a href="/" class="text-decoration-none">Ucok</a> Today
                                </small>
                            </p>

                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde, saepe!
                            </p>

                            <a href="/" class="text-decoration-none btn btn-primary btn-small">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                            <a href="/" class="text-decoration-none text-light">
                                Berita
                            </a>
                        </div>
                        <a href="/" class="text-decoration-none">
                            <img src="https://source.unsplash.com/400x200?" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">Lorem ipsum dolor sit.</h5>

                            <p>
                                <small class="text-muted">
                                    By : <a href="/" class="text-decoration-none">Ucok</a> Today
                                </small>
                            </p>

                            <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde, saepe!
                            </p>

                            <a href="/" class="text-decoration-none btn btn-primary btn-small">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection