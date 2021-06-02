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
@if(session()->get('ADMIN_ROLE')==0)
<a href="{{url('admin/orders/canelled_order_report')}}" class="btn btn-danger">Cancelled Orders </a>    
<a href="{{url('admin/orders/complete_order_report')}}" class="btn btn-success">Completed Orders </a>     
<a href="{{url('admin/orders/all_order_report')}}" class="btn btn-primary">All Orders </a>      
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
Order Id: {{$value->id}}
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


<td>
@if($value->status_id!=6 && $value->status_id!=7)
<a class="btn btn-warning" href="{{url('admin/order/status')}}/{{$value->id}}/{{$value->status_id}}">{{$value->status_name}}</a>
@endif
@if($value->status_id==1)
<a class="btn btn-danger" href="{{url('admin/order_cancel/')}}/{{$value->id}}">Cancel</a>
@endif

@if($value->status_id==6)
<a class="btn btn-danger" href="javascript:void(0)">{{$value->status_name}}</a>
@elseif($value->status_id==7)
<a class="btn btn-danger" href="javascript:void(0)">{{$value->status_name}}</a>
@endif
</td>

                            
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