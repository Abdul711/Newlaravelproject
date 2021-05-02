@extends('admin/layout')
@section('page_title','Inventory')
@section('container')
    <h1 class="mb10">Inventory</h1>
 
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            @if(session()->has('message'))

<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <span class="badge badge-pill badge-success">Congratulations</span>

    {{session('message')}}	
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif 
<a href="{{url('admin/inventory/inventory_pdf')}}">Print Out Report(PDF)</a>
<a href="{{url('admin/inventory/inventory_excel')}}">Print Out Report(Excel)</a>
            <div>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th> Date </th>
                        <th>Number Of Order </th>
                            <th>Amount Earned </th>
                       
                            <th>Total Product(Sold) </th>
                            <th>Completion Ratio (%) </th>
                            <th>Cancellation Ratio (%) </th>
                            <th>PerForm</th>
                        </tr>
                    </thead>
                    <tbody>
                
            
                 
              
      
           
             
@php
$i=2;
$total_record=count($order_dates);
$total_amount=array();  

@endphp     

               
@foreach($order_dates as $key => $customer)
@php
 $number_of=order_detail_by_date_no($customer->order_date);
 $amount_gain=amount_earned($customer->order_date);
 $amount_ratio=$amount_gain/$number_of;
 $total_ite=total_item($customer->order_date);
 $total_qt=total_qty($customer->order_date);
 $order_complete=order_complete($customer->order_date);
 $order_cancel=order_cancel($customer->order_date);
@endphp
<tr>
<td>{{$key+1}}</td>
<td>{{date("d-M-Y",strtotime($customer->order_date))}}</td>
<td>{{$number_of}}</td>
<td> {{$amount_gain}} Rs </td>

<td>{{$total_qt*$total_ite}}</td>
<td>{{number_format(($order_complete/$number_of)*100,2)}} %</td>
<td>{{number_format(($order_cancel/$number_of)*100,2)}} %</td>
@if($order_complete>$order_cancel)
<td>Good<td>
@endif
@if($order_complete==$order_cancel)
<td>Average<td>
@endif
@if($order_complete<$order_cancel)
<td>Bad<td>
@endif
</tr>



@endforeach
@php

@endphp

                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection