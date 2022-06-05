@extends('layouts.main')
@section('container')

<!-- CARI -->

    <div class="container align-self-center">
        <div class="card mb-3 mt-3">
          <div class="card-header pl-0 pr-0">
            <div class="row no-gutters w-100 align-items-center">
              <div class="col ml-3 my-2"><b>Hasil Pencarian</b></div>
            </div>
          </div>
          
        <div class="card-body py-3">
            @if($gurus->count()>0 || $admins->count()>0 || $beritas->count()>0 ||$siswas->count() > 0)
            
                @foreach ($gurus as $guru)
                    <div class="row no-gutters align-items-center">
                        <div class="col"> 
                          <a href="{{ route('guru.show', ['guru' => $guru->id]) }}" class="text-big" data-abc="true">{{ $guru->name }}</a>
                          <div class="text-muted small">Guru</div>
                          <hr class="p-0">
                        </div>
                    </div>
                @endforeach

                @foreach ($admins as $admin)
                    <div class="row no-gutters align-items-center">
                        <div class="col"> 
                          <a href="{{ route('admin.show', ['admin' => $admin->id]) }}" class="text-big" data-abc="true">{{ $admin->name }}</a>
                          <div class="text-muted small">Admin</div>
                          <hr class="p-0">
                        </div>
                    </div>
                @endforeach

                @foreach ($siswas as $siswa)
                    <div class="row no-gutters align-items-center">
                        <div class="col"> 
                          <a href="{{ route('murid.show', ['murid' => $siswa->nis]) }}" class="text-big" data-abc="true">{{ $siswa->name }} </a>
                          <div class="text-muted small">Siswa</div>
                          <hr class="p-0">
                        </div>
                    </div>
                @endforeach

                @foreach ($beritas as $berita)
                    <div class="row no-gutters align-items-center">
                        <div class="col"> 
                          <a href="{{ route('berita.tampil', ['post' => $berita->slug]) }}" class="text-big" data-abc="true">{{ $berita->title }}</a>
                          <div class="text-muted small">Berita</div>
                          <hr class="p-0">
                        </div>
                    </div>
                @endforeach
            
            @else
            <div class="card-body py-3">
              <div class="row no-gutters align-items-center">
                <div class="col">
                  <h6 class="media-heading">
                    <a href="/admin">Tidak menemukan apapun!</a>
                  </h6>
                </div>
              </div>
            </div>
            @endif
    
        </div>
      </div>
    </div>



@endsection