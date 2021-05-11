@extends('admin/layout')
@section('page_title','Inventory Daily')
@section('container')
    <h1 class="mb10">Inventory(Daily)</h1>
 
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
<td><a href="{{url('admin/order_detail_by_date/'.$customer->order_date)}}">{{date("d-M-Y",strtotime($customer->order_date))}}</a></td>
<td>{{$number_of}}</td>
<td> {{$amount_gain}} Rs </td>

<td>{{$total_qt}} </td>
<td>{{number_format(($order_complete/$number_of)*100,2)}} %</td>

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
    <div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Total Earning Detail</h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <tbody>
                                            
                                            @php
                                      $total_earning=TotalAdminEarning();
                                      $earnings=$total_earning;
                                        @endphp
                                                <tr>
                                                    <td>Total Earning</td>
                                                    <td>{{$earnings}} Rs</td>
                                                </tr>
                                                <tr>
                                                    <td>Gst </td>
                                                    <td>{{gst($earnings)}} Rs</td>
                                                </tr>
                                                <tr>
                                                    <td>Final Earning</td>
                                                    <td>{{final_earning($earnings)}} Rs</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

             
@endsection