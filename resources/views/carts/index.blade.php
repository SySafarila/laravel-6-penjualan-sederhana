@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex">
                        <span class="mr-1">Cart</span>
                    </div>
                    <div class="card-body">
                        @foreach ($carts as $cart)
                            <div>
                                <p class="font-weight-bold mb-0">{{ $cart->product->name }}</p>
                                <div class="d-flex justify-content-between">
                                    <span>Price : Rp {{ number_format($cart->price,0 ,0, ',')}}</span>
                                    <span>Quantity : {{ $cart->quantity }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Total : Rp {{ number_format($cart->total,0 ,0, ',')}}</span>
                                    <div class="d-flex">
                                        <a href="{{ route('carts.edit', $cart->id) }}" class="material-icons mr-2 text-decoration-none" style="font-size: 20px;">edit</a>
                                        <span class="material-icons text-danger" style="font-size: 20px;">remove_circle</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <a href="#" class="btn btn-sm btn-success">Pay Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
