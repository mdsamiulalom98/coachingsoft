@extends('backEnd.layouts.master')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center">
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
			    	<div class="col-auto">
			    	</div>
			         <div class="dashboard-cards mt-5">
							  <div class="show-card">
							    <div class="icon-circle purple">
							      <i class="fa-solid fa-users"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{$total_student}}</div>
							      <div class="dashboard-label">Total Student</div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle green">
							      <i class="fa-solid fa-image"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{ $total_course }}</div>
							      <div class="dashboard-label">Total Course</div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle blue">
							      <i class="fa-solid fa-calendar-check"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{$success_student}}</div>
							      <div class="dashboard-label">Success Student</div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle orange">
							      <i class="fa-solid fa-file"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{ $total_notice }}</div>
							      <div class="dashboard-label">All Notice</div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle teal">
							      <i class="fa-brands fa-dropbox"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{ $total_department }}</div>
							      <div class="dashboard-label">Total Department </div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle red">
							      <i class="fa-solid fa-user-secret"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{ $total_class }}</div>
							      <div class="dashboard-label">Total Class</div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle yellow">
							      <i class="fa-regular fa-object-ungroup"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{ $total_session }}</div>
							      <div class="dashboard-label">Total Session</div>
							    </div>
							  </div>

							  <div class="show-card">
							    <div class="icon-circle pink">
							      <i class="fa-solid fa-chart-bar"></i>
							    </div>
							    <div class="dash-content">
							      <div class="dashboard-value">{{ $total_batch }}</div>
							      <div class="dashboard-label">Total Batch</div>
							    </div>
							  </div>
						</div>
			    </div>
			</div>
		</div>
	</div>
</section>
@endsection