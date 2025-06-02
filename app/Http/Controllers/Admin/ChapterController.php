<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Course;
use App\Models\Chapter;

class ChapterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:course-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:course-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    // }
    public function index(Request $request)
    {
        $data = Chapter::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    $editBtn = '<a class="edit_btn" href="' . route('chapter.edit', $row->id) . '">
                                    <i class="ti ti-pencil"></i>
                                </a>';

                    $deleteBtn = '<form action="' . route('chapter.destroy', $row->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="delete_btn" onclick="return confirm(\'Are you sure?\')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>';

                    return $editBtn . ' ' . $deleteBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="active_btn">Active</span>';
                    } else {
                        return '<span class="inactive_btn">Inactive</span>';
                    }
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }

        return view('backEnd.chapter.index');
    }


    public function create()
    {
        $category_name = Course::where('status',1)->get();
        return view('backEnd.chapter.create', compact('category_name'));
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

        $save_data = Chapter::create($input);

       
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('chapter.index');
    }

    public function edit($id)
    {
        $edit_data = Chapter::find($id);
        $course_name = Course::where('status',1)->get();
        return view('backEnd.chapter.edit', compact('edit_data', 'course_name'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'course_id' => 'required'
        ]);
        $update_data = Chapter::find($request->hidden_id);
        $input = $request->except('hidden_id');
        
        $input['status'] = $request->status ? 1 : 0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('chapter.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Chapter::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Chapter::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = Chapter::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
