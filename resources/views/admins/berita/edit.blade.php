@extends('layouts.main')

@section('container')
<div class="row">
  <div class="col-xl-10 col-md-8 mx-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center">
          <h6 class="h2">Edit Berita</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('berita.update', ['beritum' => $post->slug]) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Judul" value="{{ old('title', $post->title) }}">
            @error('title')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $post->slug) }}" placeholder="Slug berita">
            @error('slug')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
  
          <div class="form-group">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" name="category_id" id="category">
              <option selected>Pilih Kategori</option>
              @foreach ($categories as $category)
              @if (old('category_id', $post->category_id) == $category->id)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option> 
              @else 
              <option value="{{ $category->id }}">{{ $category->name }}</option> 
              @endif
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="image">Gambar</label>
            @if ($post->image)                        
            <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-preview img-fluid mb-3 col-sm-4">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-4">
            @endif
            <input type="file" class="form-control-file  @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="body">Body</label>
            @error('body')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body)  }}">
            <trix-editor input="body"></trix-editor>
        </div>

          <button class="btn btn-primary" type="submit">Tambahkan</button>
        </form>
      </div>
    </div>
  </div>
</div>
  
<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function(){
    fetch('/admin/berita/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e) {
    e.preventDefault();
  })

  function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection