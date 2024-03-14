@extends('layouts.header')
@section('content')

<body>
    <div class="container">
        @if (Session::has('status') && Session::get('status') === 'SUCCESS')
            <h2>Payment Success</h2>
        @else
            <h2>Payment Failed</h2>  
        @endif
        <a href="{{ url('/') }}"><button class="back-btn">Home</button></a>
    </div>
</body>
</html>

@endsection