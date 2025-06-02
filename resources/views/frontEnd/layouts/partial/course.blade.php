@foreach($courses as $key=>$value)
<div class="col-sm-4">
		<div class="course-item">
			<div class="course-img">
				<a href="{{route('course.details',['id'=>$value->id])}}">
					<img src="{{asset($value->image)}}" alt="">
				</a>
			</div>
			<div class="course-content">
				<a href="{{route('course.details',['id'=>$value->id])}}" class="course_name">{{$value->title}}</a>
				<ul>
					<li class="course_fee">@if($value->old_fee)<del>{{$value->old_fee}}</del>@endif {{$value->course_fee}} Tk</li>
					<li>{{$value->total_class}}</li>
				</ul>
				<a href="{{route('course.details',['id'=>$value->id])}}" class="course_btn">এনরোল করুন</a>
			</div>
		</div>
</div>
@endforeach