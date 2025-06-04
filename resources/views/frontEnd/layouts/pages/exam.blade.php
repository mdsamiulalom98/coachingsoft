@extends('frontEnd.layouts.master')
@section('title','সকল টেস্ট পরীক্ষা সমুহ')
@section('content')
<div class="page-breadcumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">সকল টেস্ট পরীক্ষা সমুহ</h2>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- page-breadcrumb --}}

<div class="notice-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
		        <div class="table-responsive">
		            <table class="notice-table table table-bordered">
					    <thead>
					      <tr>
					        <th>নং</th>
					        <th>পরীক্ষার নাম</th>
					        <th>প্রকাশ</th>
					        <th>পরীক্ষার তারিখ</th>
					        <th>সংযুক্তি</th>
					      </tr>
					    </thead>
					    <tbody>
					      @foreach($exam as $key => $value)
					      <tr>
					        <td>{{$loop->iteration}}</td>
					        <td class="notice-title">{{ $value->title}}</td>
					        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</td>
		                    <td>{{ \Carbon\Carbon::parse($value->last_date)->format('d M, Y') }}</td>
					        @if($value->link)
					        <td><a href="{{ $value->link}}" class="download-btn">Go to Link</a></td>
					        @endif
					        
					      </tr>
					      @endforeach
					      
					    </tbody>
					  </table>
			    </div>
			</div>
		</div>
	</div>
</div>
{{-- course end --}}
@endsection