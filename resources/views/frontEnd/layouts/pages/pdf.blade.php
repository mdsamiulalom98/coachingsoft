@extends('frontEnd.layouts.master')
@section('title','সকল পিডিএফ সমুহ')
@section('content')
<div class="page-breadcumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">সকল পিডিএফ সমুহ</h2>
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
					        <th>পিডিএফ এর নাম</th>
					        <th>সংযুক্তি</th>
					        <th>প্রকাশ</th>
					        <th>শেষ তারিখ</th>
					        <th></th>
					      </tr>
					    </thead>
					    <tbody>
					      @foreach($pdf as $key => $value)
					      <tr>
					        <td>{{$loop->iteration}}</td>
					        <td class="notice-title">{{ $value->title}}</td>
					        @if($value->link)
					        <td><a href="{{ $value->link}}" class="download-btn">Download</a></td>
					        @endif
					        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</td>
		                    <td>{{ \Carbon\Carbon::parse($value->last_date)->format('d M, Y') }}</td>
					        <td><a href="{{ route('pdf.details', $value->id) }}" class="view-link">View</a></td>
					        
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