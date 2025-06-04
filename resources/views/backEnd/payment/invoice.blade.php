<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .print_section {
            text-align: center;
        }

        .print_section button {
            background: #224cc1;
            color: #fff;
            border: 0;
            padding: 8px 17px;
            margin: 10px 0;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .print_section a {
            margin-top: 15px;
            display: block;
        }
        body{
            background: #f1f1f1;
        }
        .customer-invoice {
            margin: 0 0;
        }
        .invoice_btn{
            margin-bottom: 15px;
        }
        table{
            padding: 0 30px;
        }
        p{
            margin:0;
        }
        td{
            font-size: 16px;
            font-weight: 500;
            color:#222;
        }
        .receipt_body tr{
            display: block;
            margin: 15px 0;
        }
        .receipt_body tr span{
            width:150px;
            display: inline-block;
        }
       @page { 
        margin:0px;
        }
       @media print {
         
        body{
            background: #fff;
        }
        .invoice_btn{
            margin-bottom: 0 !important;
        }
        td{
            font-size: 18px;
        }
        p{
            margin:0;
        }
        header,footer,.no-print,.left-side-menu,.navbar-custom {
          display: none !important;
        }
        .customer-invoice{
            margin-top:50px;
            margin-bottom:150px;
        }
        
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row print_section">
            <div class="col-sm-6">
                <a href="{{url('editor/payment/add')}}" class="no-print"><strong><i class="fe-arrow-left"></i> Back To Payment</strong></a>
            </div>
            <div class="col-sm-6">
                <button onclick="printFunction()"class="no-print btn btn-xs btn-success waves-effect waves-light">Print</button>
            </div>
        </div>
    </div>
@foreach($payids as $key=>$id)
@php
    $payment = App\Payment::with('classtypes','student','batch')->find($id);
@endphp
<section class="customer-invoice">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-12 mt-3">
                <div class="invoice-innter" style="width:760px;margin: 0 auto;background: #fff;overflow: hidden;padding: 30px;padding-top: 0;position:relative">
                    <table class="receipt_body" style="width:100%;">
                        @if($payment->batch->payment_type == 1)
                        <tr>
                            <td></td>
                        </tr>
                        @endif
                        <tr>
                            <td style="width: 100%;text-align: center;display: block;margin-bottom: 35px;"><h2><u>Payment Receipt</u></h2></td>
                        </tr>
                        <tr>
                            <td><span>HSC</span> : {{$payment->classtypes?$payment->classtypes->name:''}}</td>
                        </tr>
                        <tr>
                            <td><span>Program</span> : {{$payment->type=1?'Academic':'Admission'}}</td>
                        </tr>
                        <tr>
                            <td><span>Payment System</span> : Monthly</td>
                        </tr>
                        <tr>
                            <td><span>Student Name</span> : {{$payment->student?$payment->student->name:''}}</td>
                        </tr>
                        <tr>
                            <td><span>Student Roll</span> : {{$payment->student?$payment->student->roll_number:''}}</td>
                        </tr>
                        <tr>
                            <td><span>Father Name</span> : {{$payment->student?$payment->student->fathername:''}}</td>
                        </tr>
                        <tr>
                            <td><span>Collge Name</span> : {{$payment->student?$payment->student->institute:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td><span>Batch</span> : {{$payment->batch?$payment->batch->name:''}}</td>
                        </tr>
                        
                        <tr>
                            <td><span>Month</span> : {{$payment->month}}</td>
                        </tr>
                        @if($payment->batch->payment_type == 2)
                        <tr>
                            <td><span>Total Course Fee</span> : {{$payment->batch->course_fee}}</td>
                        </tr>
                        
                        <tr>
                            <td><span>Total Paid</span> : {{$payment->student?$payment->student->course_fee:'0'}}</td>
                        </tr>
                        <tr>
                            <td><span>Payment Amount</span> : {{$payment->amount}}</td>
                        </tr>
                        <tr>
                            <td><span>Due Amount</span> : {{$payment->batch->course_fee-$payment->student->course_fee}}</td>
                        </tr>
                        @if($payment->batch->course_fee != $payment->student->course_fee)
                        <tr>
                            <td><span>Next Payment Date :</span> ...................................</td>
                        </tr>
                        @endif
                        @else
                        <tr>
                            <td><span>Pay Amount</span> : {{$payment->amount}}</td>
                        </tr>
                        <tr>
                            <td><span>Payment Date</span> : {{$payment->payDate}}</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        @endif
                    </table>
                    <table style="width:100%;margin-top:60px">
                        <tr>
                            <td style="width:50%;float-left">
                                <p>..............................................</p>
                                <p>Receipient Signature & Date</p>
                            </td>
                            <td style="width:50%;float-right;text-align:right">
                                <p>............................</p>
                                <p>{{$payment->paid_by}}<p/>
                                <p>Author Signature & Date</p>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;text-align:center;margin-top:30px;margin-bottom:30px">
                        <tr>
                            <td><u>Received With Thanks</u></td>
                        </tr>
                        <tr>
                            @foreach($logo as $key=>$value)
                            <td><img src="{{asset($value->image)}}" style="width:230px" alt=""></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td><strong>Mentor: Sayfullah Al Zihadi</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Location</strong> Chaderhat Club, Mohila College Mor, Balubari, Dinajpur</td>
                        </tr>
                        <tr>
                            <td><strong>Contact No: 01330702001</strong></td>
                        </tr>
                    </table>
                     @foreach($logo as $key=>$value)
                    <img src="{{asset($value->image)}}" alt="Logo" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.2; pointer-events: none; width: auto; height: auto;">
                    @endforeach
                </div>
                   
            </div>
        </div>
    </div>
</section>
@endforeach
<script>
    function printFunction() {
        window.print();
    }
</script>
</body>
</html>