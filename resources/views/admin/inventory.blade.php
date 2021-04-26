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
<a href="{{url('admin/customers/customer_pdf')}}">Print Out Report(PDF)</a>
<a href="{{url('admin/customers/customer_excel')}}">Print Out Report(Excel)</a>
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th> Date </th>
                        <th>Number Of Order </th>
                            <th>Amount Earned </th>
                            <th>Average Amount Per Order </th>
                        </tr>
                    </thead>
                    <tbody>
                
            
                 
              
      
           
             
@php
$i=2;
$total_record=count($order_dates);
$total_amount=array();  
@endphp     

               
                    @if($total_record>0)
@foreach($order_dates as $key => $customer)
@php
 $number_of=order_detail_by_date_no($customer->order_date);
 $amount_gain=amount_earned($customer->order_date);
 $amount_ratio=$amount_gain/$number_of;
@endphp
<tr>
<td>{{$key+1}}</td>
<td>{{date("d-F-Y",strtotime($customer->order_date))}}</td>
<td>{{$number_of}}</td>
<td> {{$amount_gain}} Rs </td>
<td> {{$amount_ratio}} </td>
</tr>



@endforeach
@php

@endphp
@elseif($total_record<=0)
                        <tr>
                        <td colspan='5' class="text-center text-danger">No Sub Category Found In store</td>
                        </tr>
                        @endif
                        <tr>
                        <td colspan='7' >
                    
                        </td>
            </tr>
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection