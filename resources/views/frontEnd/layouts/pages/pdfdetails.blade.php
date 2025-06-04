@extends('frontEnd.layouts.master')
@section('title','সকল পিডিএফ সমুহ')
@section('content')
<div class="page-breadcumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">{{ $show_data->title}}</h2>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- page-breadcrumb --}}

<div class="notice-section">
	<div class="container">
		<div class="row">
			{!! $show_data->description !!}
		</div>
	</div>
</div>
{{-- course end --}}
@endsection