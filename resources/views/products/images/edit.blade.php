@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Product Images</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($images->count() == 1)
                            <div class="alert alert-secondary" role="alert">
                                At least 1 image is available
                            </div>
                        @endif

                        @foreach ($images as $image)
                            @php
                                if (Storage::disk('local')->exists('public/productImages/' . $image->image)) {
                                    $imagex = asset('/storage/productImages/' . $image->image);
                                } else {
                                    $imagex = asset('/images/image-not-found.png');
                                }
                            @endphp
                            <img src="{{ $imagex }}" alt="{{ $image->image }}" class="w-50">
                            <p class="mb-0">- {{ $image->image }}</p>
                            @if ($images->count() > 1)
                                <form action="{{ route('products.images.delete', [
                                    'product' => $image->product_id,
                                    'image' => $image->id
                                ]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                            <hr>
                        @endforeach
                        {{-- <hr> --}}
                        <form action="{{ route('products.images.upload', $image->product_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" class="border rounded-lg w-100" name="images[]" id="images" accept="image/png, image/gif, image/jpeg" multiple required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                        <div class="mt-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
