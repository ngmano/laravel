@extends('layouts.header')
@section('content')

<body>
    <div class="container">
        @if ($product)
            <div class="product">
                <h2>{{ $product->name }}</h2>
                <p class="price">₹{{ $product->price }}</p>
                <p class="description">{{ $product->description }}.</p>
            </div>
        @else
            <div class="product">
                <h2>Invalid Data</h2>
            </div>   
        @endif
        <a href="{{ route('productList') }}"><button class="back-btn">Back</button></a>

        <form id="payment-form" action="{{ route('checkout') }}" method="POST">
            @csrf
            <div class="form-row">
                <label for="cardholder-name">Cardholder Name</label>
                <input id="cardholder-name" class="cardholder-detail" type="text" name="name">
                <input type="hidden" name="id" value="{{ $product->uuid }}">
                <input type="hidden" name="intent" value="{{ $intent->client_secret }}">
            </div>
            <div class="form-row">
                <label for="card-element"> Credit or debit card</label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
            </div>
            <button id="submit-btn" data-secret="{{ $intent->client_secret }}">Pay Now</button>
        </form>
    </div>
</body>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
</html>

@endsection