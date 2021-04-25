@extends('admin/layout')
@section('page_title','Display Customer')
@section('container')
    <h1 class="mb10">Customer</h1>
 
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
                            <th>  Name / No Of Order / Amount Spend</th>
                        <th>Email  </th>
                            <th>Mobile </th>
                           
                        </tr>
                    </thead>
                    <tbody>
                
            
                 
              
      
           
             
@php
$i=2;
$total_record=   count($customers);
$total_amount=array();  
@endphp     

               
                    @if($total_record>0)
@foreach($customers as $key => $customer)
@php

$total_orders=NumberOfOrder($customer->id);
    $total_order=$total_orders["total_order"];
    $total_amount_expand=$total_orders["total_amount_expand"];
    array_push($total_amount,$total_amount_expand);
$maxTotal=max($total_amount);

    @endphp

<tr>
<td>{{$key+1}}</td>
<td>{{$customer->customer_name}}
<p> No Of Order {{$total_order}}</p>
@if($maxTotal==$total_amount_expand)
 Amount Spend <p style="color:black; background:red;">{{$total_amount_expand}} Rs</p>
 @else
 Amount Spend <p>{{$total_amount_expand}} Rs</p>
 @endif
</td>

<td> {{$customer->customer_email}}</td>

<td>{{$customer->customer_mobile}}</td>


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
                        {{$customers->links('pagination::bootstrap-4')}}
                        </td>
            </tr>
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection