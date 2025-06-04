<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\OrderStatus;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Book;

class OrderController extends Controller
{
    public function index(Request $request, $slug = 'all')
    {
        // Common base query
        if ($slug === 'all') {
            $order_status = (object) [
                'name' => 'All',
                'orders_count' => Order::count(),
            ];
            $data = Order::latest()->with('status', 'student');
        } else {
            $order_status = OrderStatus::where('slug', $slug)->withCount('orders')->first();
            $data = Order::where('order_status', $order_status->id)
                ->latest()
                ->with('status', 'student');
        }

        // If AJAX request → return JSON for DataTables
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('student_name', function ($row) {
                    return $row->student->name ?? '-';
                })
                ->addColumn('phone', function ($row) {
                    return $row->student->phone_number ?? '-';
                })
                ->addColumn('amount', function ($row) {
                    return '৳' . $row->amount ?? '-';
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '-';
                })
                ->addcolumn('status', function ($row) {
                    return '<span class="badge ' . $row->status->color . '">' . $row->status->name . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return
                        '<a class="edit_btn" href="' . route('admin.order.process', $row->invoice_id) . '">
                        <i class="ti ti-settings-cog"></i>
                    </a>';
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
        }

        // Non-AJAX: Paginate & return view
        $data = $data->paginate(50);

        // return $data;
        return view('backEnd.order.index', compact('data', 'order_status'));
    }
    public function process($invoice_id)
    {
        $data = Order::where(['invoice_id' => $invoice_id])->select('id', 'invoice_id', 'order_status')->with('orderdetails')->first();
        return view('backEnd.order.process', compact('data'));
    }

    public function order_process(Request $request)
    {
        $link = OrderStatus::find($request->status)->slug;
        $order = Order::find($request->id);
        $order_status = $order->order_status;
        $order->order_status = $request->status;
        // return $order;

        $order->save();

        if ($request->status == 4 && $order_status != 4) {
            $orders_details = OrderDetails::where('order_id', $order->id)->get();
            foreach ($orders_details as $order_detail) {
                $product = Book::find($order_detail->product_id);
                $product->stock -= $order_detail->qty;
                $product->save();

            }
        }

        Toastr::success('Success', 'Order status change successfully');
        return redirect('admin/order/' . $link);
    }
}
