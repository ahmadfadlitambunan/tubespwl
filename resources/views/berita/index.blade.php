@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="/berita">
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-success" type="submit"><i class="fas fa-fw fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <h3 class="mb-3 text-center">{{ $title }}</h3>

        @if($posts->count())
        <div class="card mb-3">
            @if($posts[0]->image)
            <div style="max-height: 400px; overflow: hidden;">
                <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid mt-3" width="1200px" height="400px">
            </div>
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" alt="{{ $posts[0]->category->name }}" class="img-fluid mt-3">
            @endif
    
            <div class="card-body">
                <a href="/berita/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">
                    <h3 class="card-title">{{ $posts[0]->title }}</h3>
                </a>
    
                <p class="mb-3">
                    <small class="text-muted">  
                        By : <a href="/berita?author={{$posts[0]->author->id }}" class="text-decoration-none" >{{$posts[0]->author->name }}</a> in <a href="/berita?category={{$posts[0]->category->id }}" class="text-decoration-none">{{$posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small> 
                </p>
    
            <p class="card-text">{!! $posts[0]->excerpt  !!}</p>
            <a href="/berita/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
    
            </div>
        </div>

        <div class="row">
            @foreach ($posts->skip(1) as $post)    
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                        <a href="/berita?category{{$post->category->id }}" class="text-decoration-none text-light">
                            {{$post->category->name }}
                        </a>
                    </div>

                    <a href="/berita/{{ $post->slug }}" class="text-decoration-none">
                        <div style="max-height: 400px; overflow: hidden;">
                            @if ($post->image)
                            <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top" alt="{{ $post->title}}" width="400px" height="200px">
                            @else
                            <img src="https://source.unsplash.com/400x200?{{ $post->title }}" class="card-img-top" alt="{{ $post->title}}">
                            @endif
                        </div>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p>
                        <small class="text-muted">  
                            By : <a href="/berita?author={{$post->author->id }}" class="text-decoration-none" >{{$post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                        </small> 
                        </p>

                        <p class="card-text">{!! $post->excerpt !!}</p>
                        
                        <a href="/berita/{{ $post->slug }}" class="text-decoration-none btn btn-primary btn-small">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-center fs-4">No post found.</p>
         @endif
        </div>
    </div>
</div>
@endsection