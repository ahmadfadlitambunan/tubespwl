@extends('layouts.main')

@section('container')    
<div class="container emp-profile">
    <form method="post" action="/siswa/profile/{{ $student->nis }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img mb-4">
                    <input type="hidden" name="oldImg" value="{{ $student->image }}">
                    @if ($student->image)                        
                    <img src="{{ asset('storage/' . $student->image) }}" alt="" class="img-preview">
                    @else
                    <img class="img-preview"> 
                    @endif
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="image" onchange="previewImage()" id="image">
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Admin" value="{{ old('name', $student->name) }}">
                    @error('name')
                      <div class="invalid-feedback">
                      {{ $message }}
                      </div>
                    @enderror
                </div>

                <p>Jenis Kelamin</p>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" 
                        @if(old('gender', $student->gender) === "male")
                       checked
                        @endif value='male'>
                        <label class="form-check-label" for="gender1">
                            Laki - laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" @if( old('gender', $student->gender) === "female" )
                        checked
                        @endif value='female'>
                        <label class="form-check-label" for="gender2">
                            Perempuan
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>           
</div>
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result ;
        }
    }

</script>
@endsection
