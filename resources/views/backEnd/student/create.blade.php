@extends('backEnd.layouts.master')
@section('title','Student Add')
@push('css')
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backEnd/assets/css/dropify.min.css')}}">
@endpush
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Student Add</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Student Add
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('students.index')}}"><i class="ti ti-plus"></i> Manage</a>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>

		<div class="page-content">
		    <div class="row">
    			<div class="col-sm-12">
                    <form action="{{ route('students.store') }}" method="POST" 
                    data-parsley-validate="" enctype="multipart/form-data">
                    @csrf
        				<div class="card">
        					<div class="card-header">
                                <h6>Basic Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="department_id" class="form-label">Department <span>*</span></label>
                                            <select class="form-control select2" name="department_id" id="department_id" required>
                                                <option value="">Select..</option>
                                                @foreach ($departments as $key=>$value)
                                                 <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="class_id" class="form-label">Class <span>*</span></label>
                                            <select class="form-control select2" name="class_id" id="class_id" required>
                                                <option value="">Select..</option>
                                            </select>
                                            @error('class_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="session_id" class="form-label">Session <span>*</span></label>
                                            <select class="form-control select2" name="session_id" id="session_id" required>
                                                <option value="">Select..</option>
                                                @foreach($sessions as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
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

               

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="batch_id" class="form-label">Batch <span>*</span></label>
                                            <select class="form-control select2" name="batch_id" id="batch_id" required>
                                                <option value="">Select..</option>
                                            </select>
                                            @error('batch_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="add_date" class="form-label">Add Date <span>*</span></label>
                                            <input type="date" class="customDate form-control " name="add_date" id="add_date" required>
                                            @error('add_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">Password <span>*</span></label>
                                            <input type="password" class="form-control " name="password" id="password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Name (English) <span>*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{old('name') }}" id="name" required="">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="bn_name" class="form-label">Name (Bangla) </label>
                                            <input type="text" class="form-control @error('bn_name') is-invalid @enderror"
                                                name="bn_name" value="{{old('bn_name') }}" id="bn_name">
                                            @error('bn_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="nick_name" class="form-label">Nick Name (English) </label>
                                            <input type="text" class="form-control @error('nick_name') is-invalid @enderror"
                                                name="nick_name" value="{{old('nick_name') }}" id="nick_name" >
                                            @error('nick_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="bn_nick_name" class="form-label">Nick Name (Bangla) </label>
                                            <input type="text" class="form-control @error('bn_nick_name') is-invalid @enderror"
                                                name="bn_nick_name" value="{{old('bn_nick_name') }}" id="bn_nick_name">
                                            @error('bn_nick_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="roll_number" class="form-label">Roll No <span>*</span></label>
                                            <input type="text" class="form-control @error('roll_number') is-invalid @enderror"
                                                name="roll_number" value="{{old('roll_number') }}" id="roll_number" required>
                                            @error('roll_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="phone_number" class="form-label">Phone Number <span>*</span></label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" value="{{old('phone_number') }}" id="phone_number" required>
                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="dob" class="form-label">Date Of Birth <span>*</span></label>
                                            <input type="text" class="form-control customDate @error('dob') is-invalid @enderror"
                                                name="dob" value="{{old('dob') }}" id="dob" required>
                                            @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="present_address" class="form-label">Present Address <span>*</span></label>
                                            <input type="text" class="form-control @error('present_address') is-invalid @enderror"
                                                name="present_address" value="{{old('present_address') }}" id="present_address" required>
                                            @error('present_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="permanent_address" class="form-label">Permanent Address <span>*</span></label>
                                            <input type="text" class="form-control @error('permanent_address') is-invalid @enderror"
                                                name="permanent_address" value="{{old('permanent_address') }}" id="permanent_address" required>
                                            @error('permanent_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image <span>*</span></label>
                                            <input type="file" class="dropify form-control @error('image') is-invalid @enderror"
                                                name="image" value="{{old('image') }}" id="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- col end --}}
                                </div>
                            </div>
        				</div>
                        {{-- card end --}}
                        <div class="card">
                            <div class="card-header">
                                <h6>Parents Information</h6>
                            </div>
                            <div class="card-body">
                               <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="father_name" class="form-label">Father's Name <span>*</span></label>
                                        <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                            name="father_name" value="{{old('father_name') }}" id="father_name" required>
                                        @error('father_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}

                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="father_phone" class="form-label">Father's Phone <span>*</span></label>
                                        <input type="text" class="form-control @error('father_phone') is-invalid @enderror"
                                            name="father_phone" value="{{old('father_phone') }}" id="father_phone" required>
                                        @error('father_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="father_profession" class="form-label">Father's Profession </label>
                                        <input type="text" class="form-control @error('father_profession') is-invalid @enderror"
                                            name="father_profession" value="{{old('father_profession') }}" id="father_profession">
                                        @error('father_profession')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}

                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="mother_name" class="form-label">Mother's Name <span>*</span></label>
                                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                            name="mother_name" value="{{old('mother_name') }}" id="mother_name" required>
                                        @error('mother_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}

                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="mother_phone" class="form-label">Mother's Phone </label>
                                        <input type="text" class="form-control @error('mother_phone') is-invalid @enderror"
                                            name="mother_phone" value="{{old('mother_phone') }}" id="mother_phone">
                                        @error('mother_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="mother_profession" class="form-label">Mother's Profession </label>
                                        <input type="text" class="form-control @error('mother_profession') is-invalid @enderror"
                                            name="mother_profession" value="{{old('mother_profession') }}" id="mother_profession">
                                        @error('mother_profession')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="local_guardian" class="form-label">Local Guardian </label>
                                        <input type="text" class="form-control @error('local_guardian') is-invalid @enderror"
                                            name="local_guardian" value="{{old('local_guardian') }}" id="local_guardian">
                                        @error('local_guardian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- col end --}}
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="lg_relation" class="form-label">Local Guardian Relation </label>
                                        <input type="text" class="form-control @error('lg_relation') is-invalid @enderror"
                                            name="lg_relation" value="{{old('lg_relation') }}" id="lg_relation">
                                        @error('lg_relation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               </div>
                            </div>
                        </div>
                        {{-- card end --}}
                        <div class="card">
                            <div class="card-header">
                                <h6>Education Information</h6>
                            </div>
                            <div class="card-body">
                               <div id="education-wrapper">
                                <div class="row education-group mb-2">
                                    <div class="col-sm-2">
                                       <div class="form-group mb-3">
                                            <label for="institute" class="form-label">Institute</label>
                                            <input type="text" name="education[0][institute]" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-3">
                                            <label for="board" class="form-label">Board</label>
                                            <input type="text" name="education[0][board]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-3">
                                            <label for="year" class="form-label">Year</label>
                                            <input type="text" name="education[0][year]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                       <div class="form-group mb-3">
                                            <label for="roll" class="form-label">Roll</label>
                                            <input type="text" name="education[0][roll]" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-sm-2">
                                       <div class="form-group mb-3">
                                            <label for="reg" class="form-label">Reg</label>
                                            <input type="text"  name="education[0][reg]" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-sm-2">
                                       <div class="form-group mb-3">
                                            <label for="gpa" class="form-label">GPA</label>
                                            <input type="text"  name="education[0][gpa]" class="form-control" >
                                       </div>
                                    </div>
                                    <div class="col-sm-12 text-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-group d-none" style="margin-top:0px">X</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm mb-3" id="add-more">+ Add More</button>
                            </div>
                        </div>
                        {{-- card end --}}
                        <div class="submit">
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </form>
    			</div>
    		</div>
		</div>
	</div>
</section>
@endsection

@push('script')
<script src="{{asset('public/backEnd/assets/js/flatpickr.js')}}"></script>
<script src="{{asset('public/backEnd/assets/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#payment_type').change(function() {
            var paymentType = $(this).val();
            console.log(paymentType);
            if (paymentType === '2') {
                $('.course_fee').show();
            } else {
                $('.course_fee').hide();
            }
        });
    });

    flatpickr(".customDate", {});
</script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>
<script>
    let count = 1;

    $('#add-more').click(function () {
        let newGroup = $('.education-group:first').clone();
        newGroup.find('input').each(function () {
            let name = $(this).attr('name');
            let updatedName = name.replace(/\[\d+\]/, `[${count}]`);
            $(this).attr('name', updatedName).val('');
        });
        newGroup.find('.remove-group').removeClass('d-none');
        $('#education-wrapper').append(newGroup);
        count++;
    });
    $(document).on('click', '.remove-group', function () {
        $(this).closest('.education-group').remove();
    });
</script>

@endpush