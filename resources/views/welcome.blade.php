@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-6 px-1 col-md-3 col-lg-2 mb-2">
            <div class="card h-100 shadow-sm" id="">
                <img src="{{ asset('/storage/productImages/' . $product->images[0]->image) }}" alt="" class="menus-image">
                <div class="card-body p-2">
                    <h6 class="card-title menu-title-wrap"><a href="{{ route('products.show', $product->id) }}" class="stretched-link text-decoration-none text-success font-weight-bold">{{ $product->name }}</a></h6>
                    <h6 class="card-subtitle text-orange font-weight-bold">Rp {{ number_format($product->price,0 ,0, ',') }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
