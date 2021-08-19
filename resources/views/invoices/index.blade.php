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
                    <div class="card-body">
                        @foreach ($invoices as $invoice)
                            <div class="d-flex justify-content-between">
                                <span>No. Invoice</span>
                                <span>{{ $invoice->code }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Date</span>
                                <span>{{ $invoice->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Status</span>
                                <span class="text-capitalize">{{ $invoice->status }}</span>
                            </div>
                            <span class="font-weight-bold">Products :</span>
                            @foreach ($invoice->invoiceProducts as $product)
                                <div class="d-flex flex-column p-2 rounded-lg shadow-sm my-1">
                                    <span>{{ $product->product }}</span>
                                    <div class="border-top d-flex justify-content-between mt-1 pt-1">
                                        <span>{{ $product->quantity }} x
                                            Rp{{ number_format($product->price, 0, 0, ',') }}</span>
                                        <span>Total : Rp{{ number_format($product->total, 0, 0, ',') }}</span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($invoice->status == 'waiting payment')
                                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Upload Payment</a>
                            @else
                                <a href="#" class="btn btn-outline-success btn-sm mt-2">Confirm Payment</a>
                            @endif
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
