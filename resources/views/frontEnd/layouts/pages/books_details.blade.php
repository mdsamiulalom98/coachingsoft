@extends('frontEnd.layouts.master')
@section('title',$details->title)
@section('content')
<div class="page-breadcumb text-start">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">{{$details->title}}</h2>
					<p>কাট্যেগরি - {{$details->category?->name}}</p>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- page-breadcrumb --}}

<div class="book-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<div class="book-image">
					<img src="{{$details->image}}" alt="">
				</div>
			</div>
			<div class="col-sm-7">
				<div class="book-details">
					<h1>{{$details->title}}</h1>
					<p>{{$details->category?->name}}</p>
				</div>
				{{-- book details end --}}
				<div class="book-authors">
					<div class="b-author">
						<div class="author-img">
							<img src="{{$details->mentor?->image}}" alt="">
						</div>
						<div class="author-name">
							<h4>{{$details->mentor?->name}}</h4>
							<p>{{$details->mentor?->designation}}</p>
						</div>
					</div>
				</div>
				{{-- book auther end --}}
				<div class="book-infoes">
					<div class="book-info bg-dark">
						<div class="book-icon">
							<i class="fa-solid fa-book"></i>
						</div>
						<div class="book-con">
							<h5>{{$details->total_page}}</h5>
							<p>Pages</p>
						</div>
					</div>
					<div class="book-info bg-warning">
						<div class="book-icon">
							<i class="fa-solid fa-star"></i>
						</div>
						<div class="book-con">
							<h5>4.5</h5>
							<p>Reviews</p>
						</div>
					</div>
					<div class="book-info bg-primary">
						<div class="book-icon">
							<i class="fa-solid fa-shopping-cart"></i>
						</div>
						<div class="book-con">
							<h5>{{$details->sold}}</h5>
							<p>Sold</p>
						</div>
					</div>
					<div class="book-info bg-danger">
						<div class="book-icon">
							<i class="fa-solid fa-shopping-cart"></i>
						</div>
						<div class="book-con">
							<h5>{{$details->stock}}</h5>
							<p>In Stock</p>
						</div>
					</div>
				</div>
				{{-- book info end --}}
				<div class="book-price-inner">
					<h6>বইটির মুল্য</h6>
					<h4> <del>{{$details->old_price}}</del> {{$details->price}} Tk</h4>
				</div>
				<form action="{{route('cart.store')}}" method="POST" class="buy-now-form">
					@csrf
					<input type="hidden" name="book_id" value="{{$details->id}}">
					<button class="buy-now-btn">Buy Now</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- course end --}}
@endsection