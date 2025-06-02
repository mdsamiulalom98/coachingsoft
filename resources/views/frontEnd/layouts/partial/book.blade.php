@foreach($books as $key=>$value)
	<div class="col-sm-6">
		<div class="book-item">
			<div class="book-img">
				<a href="{{route('book.details',['id'=>$value->id])}}">
					<img src="{{asset($value->image)}}" alt="">
				</a>
			</div>
			<div class="book-content">
				<h1>{{$value->title}}</h1>
				<h5 class="price-amount">@if($value->old_price) <del>{{$value->old_price}}</del> @endif {{$value->price}} Tk</h5>
				<a href="{{route('book.details',['id'=>$value->id])}}" class="buy-now"><i class="fa-solid fa-cart-shopping"></i> Buy Now</a>
			</div>
		</div>
	</div>
@endforeach