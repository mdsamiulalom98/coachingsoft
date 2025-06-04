<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\OrderStatus;

class OrderStatusController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order-status-list|order-status-create|order-status-edit|order-status-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:order-status-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order-status-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order-status-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = OrderStatus::orderBy('id', 'ASC');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('orderstatus.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('orderstatus.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('orderstatus.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    return $statusBtn . ' ' . $editBtn;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addcolumn('color', function ($row) {
                    return '<span class="badge ' . $row->color . '">' . $row->name . '</span>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<span class="active_btn">Active</span>';
                    } else {
                        $statusBtn = '<span class="inactive_btn">Inactive</span>';
                    }
                    return $statusBtn;
                })
                ->rawColumns(['name', 'status', 'action', 'color'])
                ->toJson();
        }

        return view('backEnd.orderstatus.index');
    }
    public function create()
    {
        return view('backEnd.orderstatus.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
            'status' => 'required',
        ]);


        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status ? 1 : 0;
        // return $input;
        OrderStatus::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('orderstatus.index');
    }

    public function edit($id)
    {
        $edit_data = OrderStatus::find($id);
        return view('backEnd.orderstatus.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'color' => 'required',
        ]);
        $update_data = OrderStatus::find($request->id);
        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('orderstatus.index');
    }

    public function inactive(Request $request)
    {
        $inactive = OrderStatus::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = OrderStatus::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = OrderStatus::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
