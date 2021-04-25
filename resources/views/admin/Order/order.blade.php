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

<a href="{{url('/print_invoice/'.$value->id)}}" class="btn btn-primary">Print  Invoice </a>
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
<p>{{date('d-M-Y',strtotime($value->created_at))}}</p>
{{date('h:i a',strtotime($value->created_at))}}
</td>
@if($value->orders_status==1)
<td><a class="btn btn-warning" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->orders_status}}">Pending</a>
<a class="btn btn-danger" href="{{url('admin/order_cancel/')}}/{{$value->id}}">Cancel</a>
</td> 
@elseif($value->orders_status==2)
<td><a class="btn btn-success" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->orders_status}}">
Under The Process</a></td>
@elseif($value->orders_status==3) 
<td><a class="btn btn-success" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->orders_status}}">
Hand Over To Rider</a></td>
@elseif($value->orders_status==4)
<td><a class="btn btn-success" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->orders_status}}">Out For Delivery</a></td>
@elseif($value->orders_status==5)
<td><a class="btn btn-success" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->orders_status}}">Delivered</a></td>
@elseif($value->orders_status==6)
<td><a class="btn btn-danger" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->orders_status}}">Cancelled</a></td>
@endif


                            
                 </tr>
                 @endforeach
              
                 @elseif($total_record<=0)
                        <tr>
                        <td colspan='5' class="text-center text-danger">No Color Found In store</td>
                        </tr>
                        @endif
                     
                     
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection