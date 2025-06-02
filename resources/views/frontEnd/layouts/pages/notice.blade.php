@extends('frontEnd.layouts.master')
@section('title','সকল নোটিশ সমুহ')
@section('content')
<div class="page-breadcumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-banner">
					<h2 class="page-name">সকল নোটিশ সমুহ</h2>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- page-breadcrumb --}}

<div class="notice-section">
	<div class="container">
		<div class="row">
			<table class="notice-table">
			    <thead>
			      <tr>
			        <th>নং</th>
			        <th>নোটিশ</th>
			        <th>সংযুক্তি</th>
			        <th>প্রকাশ</th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <td>1</td>
			        <td class="notice-title">Medical GKE Daily</td>
			        <td><a href="#" class="download-btn">Download</a></td>
			        <td>02 Dec, 2024</td>
			        <td><a href="#" class="view-link">View</a></td>
			      </tr>
			      <tr>
			        <td>2</td>
			        <td class="notice-title">Secret Files: War Edition সেট কোড তালিকা</td>
			        <td><a href="#" class="download-btn">Download</a></td>
			        <td>10 Oct, 2023</td>
			        <td><a href="#" class="view-link">View</a></td>
			      </tr>
			      <tr>
			        <td>3</td>
			        <td class="notice-title">Secret Files: War Edition টেলিগ্রাম সাপোর্ট গ্রুপ</td>
			        <td><a href="#" class="download-btn">Download</a></td>
			        <td>10 Oct, 2023</td>
			        <td><a href="#" class="view-link">View</a></td>
			      </tr>
			      <tr>
			        <td>4</td>
			        <td class="notice-title">BH Quiz Commando || Exam List & Solve</td>
			        <td></td>
			        <td>29 Jul, 2023</td>
			        <td><a href="#" class="view-link">View</a></td>
			      </tr>
			    </tbody>
			  </table>
		</div>
	</div>
</div>
{{-- course end --}}
@endsection