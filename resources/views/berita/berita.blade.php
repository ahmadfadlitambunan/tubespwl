@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">{{ $post->title }}</h1>

            <h5 class="mb-3">
                By : <a href="/berita?author={{ $post->author->id }}" class="text-decoration-none" >{{ $post->author->name }}</a> in <a href="/berita?category={{ $post->category->id }}" class="text-decoration-none">{{ $post->category->name }}</a>
            </h5>

            <div style="max-height: 400px; overflow: hidden;">
            @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid" width="1280px" height="720px">
            @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid" width="1280px" height="720px">
            @endif
            </div>
            <article class="my-3 fs-4">
                {!! $post->body!!}
            </article>
            <h6>
                <a href="/berita" class="text-decoration-none">Kembali...</a>
            </h6>
        </div>
    </div>
</div>
@endsection