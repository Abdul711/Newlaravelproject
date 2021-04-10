@extends('admin/layout')
@section('page_title','Display Placed Order')
@section('container')
    <h1 class="mb10">Order</h1>
  {{$totals}}
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
      
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th> Customer Detail</th>
                        <th>Order Pricing</th>
                            <th> Date/time </th>
                            <th colspan="3" class="text-center" > Action </th>
                        </tr>
                    </thead>
                    <tbody>
                
   
              
      
           
             
  
        

                    @php 
                 $total_record=   count($orders);
                    @endphp 
                    @if($total_record>0)
@foreach($orders as $keys => $value)

             <tr>
<td>{{$keys+1}}
<p>

<a href="{{url('/print_invoice/'.$value->id)}}" class="btn btn-primary">Print And Eamil Invoice </a>
</p>
<p>

<a href="{{url('admin/view_detail/'.$value->id)}}" class="btn btn-success">View Detail</a>
</p>
</td>


    


<td>
<p>Name:{{$value->customer_name}}</p>
<p>Mobile :{{$value->customer_phone}}</p>
<p>Email:{{$value->customer_email}}</p>
<p>Delivery Address:{{$value->customer_address}}</p>
</td>
<td>
<p>Cart Total:{{$value->total_price}} Rs </p>
<p>Gst:{{$value->gst}} Rs </p>
@if($value->delivery_charge!=0)
<p>Delivery Charge:{{$value->delivery_charge}} Rs </p>
@else
<p>Free Home Delivery </p>
@endif
@if($value->coupon_value!=0)
<p>Discount:{{$value->coupon_value}} Rs </p>
<p>Coupon Code:{{$value->coupon_code}} </p>
@else
<p>No Discount Applied</p>
<p>No Coupon Code Applied</p>

@endif
<p>Final Price {{$value->final_price}} Rs</p>
</td>
<td>
Date:{{ date("d-M-Y",strtotime($value->created_at))}}
<p>
Time:
{{ date("h:i a",strtotime($value->created_at))}}
</p>
</td>
@if($value->orders_status==0)
<td><a class="btn btn-warning" href="{{url('admin/color/status')}}/{{$value->id}}/{{$value->orders_status}}">Deactive</a></td> 
@elseif($value->orders_status==1)
<td><a class="btn btn-success" href="{{url('admin/color/status')}}/{{$value->id}}/{{$value->orders_status}}">Active</a></td> 
@endif


                            
                 </tr>
                 @endforeach
              
                 @elseif($total_record<=0)
                        <tr>
                        <td colspan='5' class="text-center text-danger">No Color Found In store</td>
                        </tr>
                        @endif
                        <tr>
                        <td colspan='7' >
                        {{$orders->links('pagination::bootstrap-4')}}
                        </td>
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection