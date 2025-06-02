<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Encoders\WebpEncoder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Mentor;
use Image;
use File;
class BookController extends Controller
{
    
    function __construct()
    {
         // $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index','store']]);
         // $this->middleware('permission:book-create', ['only' => ['create','store']]);
         // $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
       $data = Book::orderBy('id','DESC');
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                if ($row->status == 1) {
                    $statusBtn = '<form method="POST" action="'.route('books.inactive').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                } else {
                    $statusBtn = '<form method="POST" action="'.route('books.active').'" class="status_form" style="display:inline;">
                                      '.csrf_field().'
                                      <input type="hidden" name="id" value="'.$row->id.'">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                }
                $editBtn = '<a class="edit_btn" href="' . route('books.edit', $row->id) . '">
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
         return view('backEnd.book.index');
    }
    public function create()
    {
        $mentors = Mentor::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        return view('backEnd.book.create',compact('mentors','categories'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'mentor_id' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/book/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
        }else{
            $imageUrl = NULL;
        }
        $input = $request->all();
        $input['status'] = $request->status ?? 1;
        $input['image'] = $imageUrl;
        Book::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        $edit_data = Book::find($id);
        $mentors = Mentor::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        return view('backEnd.book.edit',compact('edit_data','mentors','categories'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'mentor_id' => 'required',
            'description' => 'required'
        ]);

        $update_data = Book::find($request->id);
        $input = $request->all();
        $file = $request->file('image');
        if($file){
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $image = Image::read($file);
            $uploadpath = 'public/uploads/course/';
            $imageUrl = $uploadpath.$filename; 
            $image->encode(new WebpEncoder(quality: 80))
            ->save($imageUrl);
            $input['image'] = $imageUrl;
        }else{
            $imageUrl = $update_data->image;
            $input['image'] = $imageUrl;
        }

        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('books.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Book::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Book::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Book::find($request->id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
