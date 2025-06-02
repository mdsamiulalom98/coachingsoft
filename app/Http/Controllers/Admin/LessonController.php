<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;

class LessonController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:course-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:course-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    // }

    
    public function getSubcategory(Request $request)
    {
        $data = Chapter::where('course_id', $request->course_id)->pluck('title', 'id');
        return response()->json($data);
    }

    
    public function index(Request $request)
    {
       $data = lesson::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('lesson.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('lesson.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('lesson.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                return $statusBtn . ' ' . $editBtn;
            })
            ->addColumn('status', function($row) {
                if($row->status == 1){
                    $statusBtn = '<span class="active_btn">Active</span>';
                }else{
                    $statusBtn = '<span class="inactive_btn">Inactive</span>';
                }
                return $statusBtn;
            })
            ->rawColumns(['status','action'])
            ->toJson();
        }
         return view('backEnd.lesson.index');
    }

    public function create()
    {
        $categories = Course::where('status', 1)->select('id', 'title', 'status')->get();
        $category_name = Course::where('status',1)->get();
        $chapter_name = Chapter::where('status',1)->get();
        // return $chapter_name;
        return view('backEnd.lesson.create', compact('category_name','chapter_name','categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'course_id' => 'required',
        ]);
        // return $request->all();
        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);

        $save_data = lesson::create($input);

       
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('lesson.index');
    }

    public function edit($id)
    {
        $edit_data = lesson::find($id);
        $categoryId = lesson::find($id)->course_id;


        $subcategoryId = lesson::find($id)->chapter_id;
        $subcategory = Chapter::where('course_id', '=', $categoryId)->select('id', 'title', 'status')->get();
        $course_name = Course::where('status',1)->get();
        return view('backEnd.lesson.edit', compact('edit_data', 'course_name', 'subcategory'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'course_id' => 'required'
        ]);
        // return $request->all();
        $input = $request->all();
        $input = $request->except('hidden_id');
        $update_data = lesson::find($request->hidden_id);

        
        $input['status'] = $request->status ? 1 : 0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('lesson.index');
    }

    public function inactive(Request $request)
    {
        $inactive = lesson::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = lesson::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = lesson::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
