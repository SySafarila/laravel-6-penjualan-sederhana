@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('seller.search.products') }}" method="get" class="d-flex mb-4">
            <input type="text" name="name" id="name" class="form-control mr-1" placeholder="Search products here...">
            <button type="submit" class="btn btn-success material-icons">search</button>
        </form>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex">
                        <span class="mr-1">Products</span>
                        <a href="{{ route('products.create') }}" class="material-icons text-decoration-none"
                            style="font-size: 20px;">add</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $number++ }}</th>
                                            <td><a
                                                    href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ number_format($product->price, 0, 0, ',') }}</td>
                                            <td class="d-flex text-center">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="material-icons text-decoration-none"
                                                    style="font-size: 20px;">mode_edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="material-icons text-danger text-decoration-none"
                                                        style="font-size: 20px; border: none;">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($products->count() == 0)
                                <p class="text-center m-0 py-2">Empty</p>
                            @else
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
