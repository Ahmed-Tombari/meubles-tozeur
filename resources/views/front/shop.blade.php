@extends('front.layout.layout')

@section('title', 'Shop - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">

            @foreach($products as $product)
            <!-- Start Column -->
            <div class="col-12 col-md-4 col-lg-3 mb-5">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="product-item border-0 bg-transparent text-start p-0">
                        @if(Str::startsWith($product->image, 'front/'))
                            <img src="{{ asset($product->image) }}" class="img-fluid product-thumbnail">
                        @else
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid product-thumbnail">
                        @endif
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <strong class="product-price">${{ number_format($product->price, 2) }}</strong>
                        <span class="icon-cross">
                            <img src="{{ asset('front/images/cross.svg') }}" class="img-fluid">
                        </span>
                    </button>
                </form>
            </div> 
            <!-- End Column -->
            @endforeach

        </div>
    </div>
</div>
@endsection
