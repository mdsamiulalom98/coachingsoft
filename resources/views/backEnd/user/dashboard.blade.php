@extends('backEnd.layouts.master')
@section('content')

<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Dashboard</h4>
	            		</div>
						   <ul class="breadcrumb">
							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Dashboard
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto"></div>
			    </div>
			</div>
		</div>
	</div>
</section>
@endsection