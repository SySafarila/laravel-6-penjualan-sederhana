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
                        <span class="mr-1">Invoices</span>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <th scope="row">{{ $number++ }}</th>
                                        <td><a href="{{ route('seller.invoices.show', $invoice->id) }}">{{ $invoice->code }}</a></td>
                                        <td class="text-capitalize">{{ $invoice->status }}</td>
                                        <td>Rp{{ number_format($invoice->total, 0, 0, ',') }}</td>
                                    </tr>
                                @endforeach
                                @if ($invoices->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">Empty</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-2 d-flex justify-content-center">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
