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
                        <span class="mr-1">{{ $invoice->code }}</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex font-weight-bold justify-content-between">
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
                        <div class="d-flex justify-content-between">
                            <span>Total</span>
                            <span class="font-weight-bold">Rp{{ number_format($invoice->total, 0, 0, ',') }}</span>
                        </div>
                        <span class="font-weight-bold">Products :</span>
                        @foreach ($invoice->invoiceProducts as $product)
                            <div class="d-flex flex-column p-3 rounded-lg border my-1">
                                <span>{{ $product->product }}</span>
                                <div class="border-top d-flex justify-content-between mt-1 pt-1">
                                    <span>{{ $product->quantity }} x
                                        Rp{{ number_format($product->price, 0, 0, ',') }}</span>
                                    <span>Total : Rp{{ number_format($product->total, 0, 0, ',') }}</span>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        @if ($invoice->status == 'waiting payment')
                            <form action="{{ route('invoices.uploadImage', $invoice->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <label for="image">Upload your payment*</label>
                                <input type="file" name="image" id="image" class="border rounded-lg w-100" required>
                                <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Upload Payment</button>
                            </form>
                        @endif
                        @if ($invoice->status == 'payment success')
                            <p class="font-weight-bold">Payment Image</p>
                            <a href="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}">
                                <img src="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}"
                                    alt="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}" class="w-50">
                            </a>
                            <br>
                            <a href="#" class="btn btn-outline-success btn-sm mt-2"
                                onclick="alert('Confirm via WA');">Confirm Payment</a>
                            <a href="#" class="btn btn-outline-danger btn-sm mt-2" onclick="alert('Confirm via WA');">Cancel
                                Payment</a>
                        @endif
                        @if ($invoice->status == 'complete')
                            <p class="font-weight-bold">Payment Image</p>
                            <a href="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}">
                                <img src="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}"
                                    alt="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}" class="w-50">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
