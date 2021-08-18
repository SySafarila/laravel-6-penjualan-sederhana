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
                        <span class="mr-1">Products</span>
                        <a href="{{ route('products.create') }}" class="material-icons text-decoration-none" style="font-size: 20px;">add</a>
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
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ number_format($product->price, 0, 0, ',') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="material-icons text-decoration-none"
                                                    style="font-size: 20px;">mode_edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn material-icons text-decoration-none">delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
