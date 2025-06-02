@extends('frontEnd.layouts.master')
@section('title','সকল বই সমুহ')
@section('content')
<div class="page-breadcumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">সকল বই সমুহ</h2>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- page-breadcrumb --}}

<div class="course-section">
	<div class="container">
		<div class="row">
			@include('frontEnd.layouts.partial.book')
		</div>
	</div>
</div>
{{-- course end --}}
@endsection