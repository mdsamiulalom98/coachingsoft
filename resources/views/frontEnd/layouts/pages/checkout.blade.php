@extends('frontEnd.layouts.master')
@section('title','Checkout')
@section('content')
<div class="page-breadcumb text-start">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">Checkout</h2>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- page-breadcrumb --}}
<section class="checkout-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="checkout-header">
					<h5 class="checkout_title">Delivery Information</h5>
					<form action="{{route('order.save')}}" class="row" method="POST">
						@csrf
						<div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name <span>*</span></label>
                                <input type="text" placeholder="Enter Your Name" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{old('name') }}" id="name" required="">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--  col end --}}
						<div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone <span>*</span></label>
                                <input type="text" placeholder="Enter Your Phone" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{old('phone') }}" id="phone" required="">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--  col end --}}
						<div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address <span>*</span></label>
                                <textarea type="text" placeholder="Enter Your Address" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{old('address') }}" id="address" required=""></textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--  col end --}}
						<div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="area" class="form-label">Delivery Area <span>*</span></label>
                                <select type="text" placeholder="Enter Your Address" class="form-control @error('area') is-invalid @enderror"
                                    name="area" value="{{old('area') }}" id="area" required="">
                                    <option value="">Select Area</option>
                                    <option value="Inside Dinajpur">Inside Dinajpur</option>
                                    <option value="Outside Dinajpur">Outside Dinajpur</option>
                                </select>
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--  col end --}}
						<div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="note" class="form-label">Note(optional)</label>
                                <textarea type="text" placeholder="Enter Your Note" class="form-control @error('note') is-invalid @enderror"
                                    name="note" value="{{old('note') }}" id="note"></textarea>
                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--  col end --}}
						<div class="col-sm-12">
                            <div class="form-group mb-3">
                               <button class="buy-now-btn" type="submit">Confirm Order</button>
                            </div>
                        </div>
                        {{--  col end --}}
					</form>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="checkout-header">
					<h5 class="checkout_title">Cart Information</h5>
					<p>You can remove or update the quantity of the books in your cart.</p>
				</div>
				<div class="cart-infoes">
					@foreach(Cart::content() as $cart)
					<div class="cart-item">
						<div class="cart-img">
							<img src="{{ asset($cart['options']['image'] ?? '') }}" alt="">
						</div>
						<div class="cart-content">
                            <h4>{{$cart['name']}}</h4>
                            <button class="cart_remove" ><i class="fa-solid fa-trash"></i> Remove</button>
						</div>
						<div class="cart-pricing">
							<div class="qty-wrapper">
							  <button type="button" class="qty-btn minus">-</button>
							  <input type="text" class="qty-input" value="{{$cart['quantity']}}" readonly />
							  <button type="button" class="qty-btn plus">+</button>
							</div>
							<div class="cart-price">
								<h4> @if($cart['options']['old_price'])<del>{{$cart['options']['old_price']}}</del>@endif {{$cart['price'] * $cart['quantity']}} Tk</h4>
							</div>
						</div>
					</div>
					@endforeach
					<table class="table custom-table">
						<tbody>
							<tr>
								<td><strong>Total Amount</strong></td>
								<td><strong>{{Cart::total()}} Tk</strong></td>
							</tr>
							<tr>
								<td>Delivery charge</td>
								<td class="text-success">{{Session::get('shipping_fee')??0}} Tk</td>
							</tr>
							<tr>
								<td>Discount</td>
								<td class="text-success">{{Session::get('discount')??0}} Tk</td>
							</tr>
							<tr>
								<td><strong>Total</strong></td>
								<td><strong>{{Cart::total()+Session::get('shipping_fee')??0 - Session::get('discount')??0}} Tk</strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection