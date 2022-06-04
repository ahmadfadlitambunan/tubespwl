@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-xl-5 col-md-5 mx-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center">
                <h6 class="mr-auto font-weight-bold text-primary">Menabung</h6>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('create') }}">
                    @csrf


                    <div class="form-group col-xl-7">
                        <label for="deposit">Deposit</label>
                        <input type="number" class="form-control @error('deposit') is-invalid @enderror" id="deposit" name="deposit" placeholder="Deposit" value="{{ old('deposit') }}">
                        @error('deposit')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                    </div>

                    <div class="form-group col-xl">
                        <label for="image">Bukti Transfer</label>
                        <img class="img-preview img-fluid mb-3 col-sm-4">
                        <input type="file" class="form-control-file  @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-xl-3">
                        <label for="payment_id">Pembayaran</label>
                        <select class="form-select @error('payments') is-invalid @enderror" name="payment_id" id="payment_id" required>
                            <option value="" selected>Pembayaran</option>
                            @foreach ($payments as $payment)
                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                            @endforeach
                        </select>
                        @error('payment_id')
                          <div class="invalid-feedback">
                          {{ $message }}
                          </div>
                        @enderror
                    </div>

                    <input type="hidden" value="2" name="method_id">
                    <button type="submit" class="btn btn-primary mt-3">Menabung</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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