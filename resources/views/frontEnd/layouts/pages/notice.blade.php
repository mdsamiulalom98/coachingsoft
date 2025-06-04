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
		    <div class="col-12">
		        <div class="table-responsive">
		            <table class="notice-table table table-bordered">
		                <thead class="thead-light">
		                    <tr>
		                        <th>নং</th>
		                        <th>নোটিশ</th>
		                        <th>সংযুক্তি</th>
		                        <th>প্রকাশ</th>
		                        <th>শেষ তারিখ</th>
		                        <th></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    @foreach($notice as $key => $value)
		                        <tr>
		                            <td>{{ $loop->iteration }}</td>
		                            <td class="notice-title">{{ $value->title }}</td>
		                            <td>
		                                @if($value->link)
		                                    <a href="{{ $value->link }}" class="btn btn-sm btn-primary">Download</a>
		                                @else
		                                    —
		                                @endif
		                            </td>
		                            <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</td>
		                            <td>{{ \Carbon\Carbon::parse($value->last_date)->format('d M, Y') }}</td>
		                            <td>
		                                <a href="{{ route('notice.details', $value->id) }}" class="view-link">View</a>
		                            </td>
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