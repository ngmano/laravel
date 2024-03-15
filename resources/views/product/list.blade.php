@extends('layouts.header')
@section('content')

<body>
    <div class="container">
        <div class="product-grid">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="product">
                        <h2>{{ $product->name }}</h2>
                        <p class="price">₹{{ $product->price }}</p>
                        <a href="{{ route('productView', ['product' => $product]) }}"><button class="buy-btn">Buy Now</button></a>
                    </div>
                @endforeach
            @else
            <div class="product">
                <h2>No Products</h2>
            </div>
            @endif  
        </div>  
    </div>
</body>
</html>

@endsection