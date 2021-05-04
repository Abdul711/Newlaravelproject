@extends('admin/layout')
@section('page_title','Inventory Monthly')
@section('container')
    <h1 class="mb10">Inventory(Monthly)</h1>
 
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
<a href="{{url('admin/inventory/monthly_inventory_pdf')}}">Print Out Report(PDF)</a>
<a href="{{url('admin/inventory/monthly_inventory_excel')}}">Print Out Report(Excel)</a>
            <div>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                         <th>S.No</th>
                            <th> Month(days) </th>
                        <th>Number Of Order </th>
                        <th>Gst </th>
                            <th>Amount Earned </th>
                       
                      
                        
                      
                        </tr>
                    </thead>
                    <tbody>
                
            
                 
              
      
           
             
@php
$i=0;
$total_record=count($order_months);


@endphp     

               
@foreach($order_months as $key => $customer)
@php
$i=$i+1;
$m="2021-02";
$po=monthly_inve($customer);

$number_of_day=$po["number_of_day"];
$gst=$po["gst_income"];
$total_order=$po["total_order"];
$final_earning=$po["final_earning"];
@endphp
<tr>
<td>{{$i}}</td>
<td>{{date("F-Y",strtotime($customer))}} ({{$number_of_day}}) </td>
<td>{{$total_order}}</td>
<td>{{$gst}} Rs </td>
<td>{{$final_earning}} Rs</td>
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