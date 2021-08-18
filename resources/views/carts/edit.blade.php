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
                        <span class="mr-1">Edit Cart</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('carts.update', $cart->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $cart->quantity }}" min="1">
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
