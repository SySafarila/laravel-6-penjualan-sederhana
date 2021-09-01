@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('search.invoices') }}" method="get" class="d-flex mb-4">
            <input type="text" name="code" id="code" class="form-control mr-1" placeholder="Search invoices here...">
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
                        <span class="mr-1">Invoices</span>
                    </div>
                    <div class="card-body">
                        @foreach ($invoices as $invoice)
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
                            <div id="actions" class="align-items-baseline d-flex justify-content-between mt-2">
                                @if ($invoice->status == 'waiting payment')
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-outline-primary btn-sm mt-2">Upload Payment</a>
                                {{-- @else
                                    <a href="#" class="btn btn-outline-success btn-sm mt-2"
                                        onclick="alert('Confirm via WA');">Confirm Payment</a> --}}
                                @endif
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="align-items-end d-flex text-decoration-none">
                                    <span>Detail</span>
                                    <span class="material-icons">chevron_right</span>
                                </a>
                            </div>
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                        @if ($invoices->count() == 0)
                            <p class="mb-0">Empty</p>
                        @endif
                        <div class="d-flex justify-content-center mt-4">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
