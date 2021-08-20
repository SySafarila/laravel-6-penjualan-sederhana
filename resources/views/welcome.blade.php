@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('search.products') }}" method="get" class="d-flex mb-4">
            <input type="text" name="name" id="name" class="form-control mr-1" placeholder="Search products here...">
            <button type="submit" class="btn btn-success material-icons">search</button>
        </form>
        <div class="row justify-content-center">
            @foreach ($products as $product)
                @php
                    if (Storage::disk('local')->exists('public/productImages/' . $product->images[0]->image)) {
                        $image = asset('/storage/productImages/' . $product->images[0]->image);
                    } else {
                        $image = asset('/images/image-not-found.png');
                    }
                @endphp
                <div class="col-6 px-1 col-md-3 col-lg-2 mb-2">
                    <div class="card h-100 shadow-sm" id="">
                        <img src="{{ $image }}" alt="" class="p-2" style="width: 100%;height:10rem;object-fit: contain;background: #f1f1f1;">
                        <div class="card-body p-2">
                            <h6 class="card-title menu-title-wrap"><a href="{{ route('products.show', $product->id) }}"
                                    class="stretched-link text-decoration-none text-success font-weight-bold">{{ $product->name }}</a>
                            </h6>
                            <h6 class="card-subtitle text-orange font-weight-bold">Rp
                                {{ number_format($product->price, 0, 0, ',') }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $products->links() }}
        </div>
    </div>
@endsection
