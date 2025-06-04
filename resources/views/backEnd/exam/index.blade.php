@extends('backEnd.layouts.master')
@section('title','Exam Manage')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Exam Manage</h4>
	            		</div>
						   <ul class="breadcrumb">
							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Exam Manage
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('exams.create')}}"><i class="ti ti-plus"></i> New</a>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>

		<div class="page-content">

		    <div class="row">
    			<div class="col-sm-12">
    				<div class="card">
    					<div class="card-header">
                            <h6>Exam Manage</h6>
                        </div>
    					<div class="card-body">
                            <div class="row ">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control select2" name="department_id" id="department_id">
                                            <option value="">Select Department..</option>
                                            @foreach ($departments as $key=>$value)
                                             <option value="{{ $value->id }}" {{request('department_id') == $value->id ? 'selected' : ''}}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                        <select class="form-control select2" name="class_id" id="class_id">
                                            <option value="">Select Class..</option>
                                             @foreach($classrooms as $key=>$value)
                                            <option value="{{$value->id}}" {{request('class_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control select2" name="session_id" id="session_id">
                                            <option value="">Select Session..</option>
                                            @foreach($sessions as $key=>$value)
                                            <option value="{{$value->id}}" {{request('session_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                        <select class="form-control select2" name="batch_id" id="batch_id">
                                            <option value="">Select Batch..</option>
                                            @foreach($batches as $key=>$value)
                                            <option value="{{$value->id}}" {{request('batch_id') == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('batch_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group ">
                                       <button class="btn btn-success" id="filter">Search</button>
                                    </div>
                                </div>
                                <!-- col end -->
                            </div>
    						<table class="table table-striped" id="data-table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Department</th>
                                        <th>Session</th>
                                        <th>Batch</th>
                                        <th>Exam</th>
                                        <th>Marks</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
    					</div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</section>
@push('script')
<!-- DataTables JS -->
<script src="{{asset('public/backEnd/assets/')}}/js/dataTables.js"></script>
<script src="{{asset('public/backEnd/assets/')}}/js/dataTables.bootstrap5.js"></script>
<script>
   $(function(){
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('exams.index') }}",
            data: function (d) {
                d.department_id = $('#department_id').find('option:selected').val();
                d.class_id = $('#class_id').find('option:selected').val();
                d.session_id = $('#session_id').find('option:selected').val();
                d.batch_id = $('#batch_id').find('option:selected').val();
            }
        },
        pageLength: 50,
        lengthMenu: [50, 100, 200, 500],
        columns:[
             { 
                data: null, 
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false, 
                searchable: false
            },
            {data: 'department_name', name:'department.name'},
            {data: 'session_name', name:'session.name'},
            {data: 'batch_name', name:'batch.name'},
            {data: 'title', name:'title'},
            {data: 'marks', name:'marks'},
            {data: 'status', name:'status'},
            {data: 'action', name:'action'},
        ]
    });

    $('#filter').click(function () {
        table.ajax.reload();
    });

    // Reset button
    $('#reset').click(function () {
        $('#department_id, #class_id, #session_id, #batch_id').val('').trigger('change');
        table.ajax.reload();
    });

   })
</script>
@endpush
@endsection