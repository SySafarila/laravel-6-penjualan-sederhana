@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $image)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img src="{{ asset('/storage/productImages/' . $image->image) }}" class="d-block w-100" alt="{{ asset('/storage/productImages/' . $image->image) }}" style="width: auto;
                                height: 300px;
                                object-fit: contain;">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="material-icons text-light bg-secondary rounded-pill">chevron_left</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="material-icons text-light bg-secondary rounded-pill">chevron_right</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-success font-weight-bold mb-1">{{ $product->name }}</h5>
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="card-subtitle m-0 text-orange font-weight-bold">Rp {{ number_format($product->price,0 ,0, '.') }}</h6>
                            {{-- <span class="badge badge-pill badge-success align-middle" style="white-space: pre;">Stock : {{ $product->stock }}</span> --}}
                        </div>
                        <p class="card-text">{{ $product->description }}</p>
                        <form action="{{ route('carts.store') }}" method="post">
                            @csrf
                            <input type="number" name="quantity" id="quantity" class="form-control mb-2" value="1" min="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-block btn-success">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
