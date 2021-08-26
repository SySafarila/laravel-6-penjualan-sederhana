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
                        <span class="mr-1 text-uppercase">{{ $invoice->code }}</span>
                    </div>
                    <div class="card-body">
                        <div class="border d-flex flex-column mb-3 p-3 rounded-lg">
                            <span class="font-weight-bold">Buyer Information</span>
                            <span>Name : {{ $invoice->user->name }}</span>
                            <span>Email : {{ $invoice->user->email }}</span>
                            <span>Registered : {{ $invoice->user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="d-flex font-weight-bold justify-content-between">
                            <span>No. Invoice</span>
                            <span class="text-uppercase">{{ $invoice->code }}</span>
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
                        @if ($invoice->status == 'waiting payment')
                            {{-- <form action="{{ route('invoices.uploadImage', $invoice->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <label for="image">Upload your payment*</label>
                            <input type="file" name="image" id="image" class="border rounded-lg w-100" required>
                            <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Upload Payment</button>
                        </form> --}}
                        @endif
                        @if ($invoice->status == 'payment success')
                            <hr>
                            <p class="font-weight-bold">Payment Image</p>
                            <a href="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}">
                                <img src="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}"
                                    alt="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}" class="mb-2 w-50">
                            </a>
                            <br>
                            <form action="{{ route('invoices.acceptPayment', $invoice->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success btn-sm mt-2">Accept Payment</button>
                            </form>
                            <form action="{{ route('invoices.declinePayment', $invoice->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Decline Payment</button>
                            </form>
                        @endif
                        @if ($invoice->status == 'complete')
                            <hr>
                            <p class="font-weight-bold">Payment Image</p>
                            <a href="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}">
                                <img src="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}"
                                    alt="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}" class="mb-2 w-50">
                            </a>
                            {{-- <br>
                            <form action="{{ route('invoices.acceptPayment', $invoice->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success btn-sm mt-2">Accept Payment</button>
                            </form>
                            <a href="#" class="btn btn-outline-danger btn-sm mt-2">Decline Payment</a> --}}
                        @endif
                        @if ($invoice->status == 'declined')
                            <hr>
                            <p class="font-weight-bold">Payment Image</p>
                            <a href="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}">
                                <img src="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}"
                                    alt="{{ asset('/storage/paymentImages/' . $invoice->payment_image) }}" class="mb-2 w-50">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
