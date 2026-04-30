@extends('front.layout.layout')

@section('title', 'Cart - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart as $id => $details)
                            <tr>
                                <td class="product-thumbnail">
                                    @if(Str::startsWith($details['image'], 'front/'))
                                        <img src="{{ asset($details['image']) }}" alt="Image" class="img-fluid">
                                    @else
                                        <img src="{{ asset('storage/' . $details['image']) }}" alt="Image" class="img-fluid">
                                    @endif
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{ $details['name'] }}</h2>
                                </td>
                                <td>${{ number_format($details['price'], 2) }}</td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease" type="button" data-id="{{ $id }}">&minus;</button>
                                        </div>
                                        <input type="text" class="form-control text-center quantity-amount" value="{{ $details['quantity'] }}" placeholder="" data-id="{{ $id }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase" type="button" data-id="{{ $id }}">&plus;</button>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-black btn-sm">X</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="{{ route('cart.index') }}" class="btn btn-black btn-sm btn-block text-white">Update Cart</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('shop') }}" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ number_format($total, 2) }}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ number_format($total, 2) }}</strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-black btn-lg py-3 btn-block text-white" href="{{ route('cart.checkout') }}">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateCart = (id, quantity) => {
            fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id, quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        };

        document.querySelectorAll('.increase').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector(`.quantity-amount[data-id="${id}"]`);
                let qty = parseInt(input.value);
                updateCart(id, qty);
            });
        });

        document.querySelectorAll('.decrease').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector(`.quantity-amount[data-id="${id}"]`);
                let qty = parseInt(input.value);
                updateCart(id, qty);
            });
        });
    });
</script>
@endpush
