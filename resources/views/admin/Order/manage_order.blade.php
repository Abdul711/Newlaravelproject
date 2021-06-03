@extends('admin/layout')
@section('page_title',"$page_title")
@section('container')
<h1 class="mb10">{{$page_title}}</h1>

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
<div class="order_detail">
<p>Total Item : {{$total_item}} </p>
<p>Customer Name : {{$order_detail[0]->customer_name}}</p>
<p>Customer Email: {{$order_detail[0]->customer_email}}</p>
<p>Customer Mobile : {{$order_detail[0]->customer_phone}}</p>
<p>Customer Address: {{$order_detail[0]->customer_address}}</p>
<p>Expected Delivery Date: {{date("d-M-Y h:i a",strtotime($order_detail[0]->delivery_expected_time))}}</p>
<p> Delivery Type: {{ucfirst($order_detail[0]->delivery_type)}}</p>
@if($order_detail[0]->customer_payment=="Wallet" && $order_detail[0]->remaining_amount>0)
<p>Payment Type:COD & Wallet </p>
@else
    @if($order_detail[0]->customer_payment=="COD")
    <p>Payment Type:Cash On Delivery </p>
    @else
<p>Payment Type:{{ucfirst($order_detail[0]->customer_payment)}} </p>
@endif
@endif
<p>Order Date: {{date("d-M-Y",strtotime($order_detail[0]->created_at))}}</p>
<p>Order Time: {{date("h:i a",strtotime($order_detail[0]->created_at))}}</p>

@if($order_detail[0]->payment_status==1)
<p>Payment Status : Success </p>
@else
<p>Payment Status : Pending </p>
@endif
Order Status:{{orders_status($order_detail[0]->id)}}
</div>
<a href="{{url('admin/print_invoice/'.$order_detail[0]->id)}}" class="btn btn-primary">Print Invoice </a>

      
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Product Name</th>
                        <th>Qty</th>
                            <th> Prrice </th>
                            <th> Total </th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($cart_details as $key => $cart_detail)
   
              <tr>
              <td>
              {{$key+1}}
              </td>
      <td>
      {{$cart_detail->name}}
     @if($cart_detail->color_name!="")
      <p>Color:{{$cart_detail->color_name}}</p>
      @endif
      @if($cart_detail->size_name!="")
      <p>Size:{{$cart_detail->size_name}}</p>
      @endif
      <p>Brand:{{$cart_detail->brands}}</p>
      <img src="{{asset('storage/media/'.$cart_detail->image)}}" width="150" height="150">
      
      </td>
      <td>{{$cart_detail->qty}}</td>
      <td>{{$cart_detail->price}}Rs</td>
      <td>{{$cart_detail->price * $cart_detail->qty}}Rs</td>
      </tr>
           
             
  
        @endforeach

            
         






                            
             
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</div>


 

<div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Cart Detail</h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <tbody>
                                            
                                            
                                          
                                        
                                                <tr>
                                                    <td>Cart Total</td>
                                                    <td>{{$order_detail[0]->total_price}} Rs</td>
                                                </tr>
                                                <tr>
                                                    <td>Delivery Charge</td>
                                            
                                                    @if($order_detail[0]->delivery_charge!=0)
                                                    <td>{{$order_detail[0]->delivery_charge}} Rs</td>
                                                    @else
                                                    <td>Free Delivery</td>
                                           
                                                    @endif
                                                </tr>
                                                  
                                                <tr>
                                                    <td>Gst</td>
                                                    <td>{{$order_detail[0]->gst}} Rs</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount</td>
                                            
                                                    @if($order_detail[0]->coupon_value!=0)
                                                    <td>{{$order_detail[0]->coupon_value}} Rs</td>
                                                    @else
                                                    <td>No Discount Applied</td>
                                           
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>Coupon Code</td>
                                            
                                                    @if($order_detail[0]->coupon_value!=0)
                                                    <td>{{$order_detail[0]->coupon_code}} </td>
                                                    @else
                                                    <td>No Coupon Code Applied</td>
                                           
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>Final Price</td>
                                                    <td>{{$order_detail[0]->final_price}} Rs</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

@if(session()->get('ADMIN_ROLE')==0||session()->get('ADMIN_ROLE')==1)

                                <div class="top-campaign">
                                
                                    <div class="table-responsive">
<form method="POST" action="">
@if (orders_status_id(($order_detail[0]->id))!=5)

Change Status
<select name="orders_status">
@foreach($statuses as $status)
@if($status->id!=1)
@if(orders_status_id(($order_detail[0]->id)) == $status->id)

<option value="{{$status->id}}" selected>{{$status->status_name}}</option>
@else
<option value="{{$status->id}}">{{$status->status_name}}</option>
@endif
@endif
@endforeach
</select><br>
@endif
@if(session()->get("ADMIN_ROLE")==0)
 @if (orders_status_id(($order_detail[0]->id))!=5)

Rider 
<select name="delivery_boy_id">
@foreach($riders as $rider)
<option value="{{$rider->id}}"> {{$rider->user_name}} </option>
@endforeach
</select></br>
@else
Rider Name : {{$riders_detail[0]->user_name}}
Rider Mobile : {{$riders_detail[0]->mobile}}
<br>
@endif


@endif
Customer Addrees
@if (orders_status_id(($order_detail[0]->id))!=5)
<input type="text" name="customer_address" class="form-control" value="{{$order_detail[0]->customer_address}}">
@else
{{$order_detail[0]->customer_address}}
@endif
<input type="hidden" name="id" value="{{$order_detail[0]->id}}">
@csrf
@if (orders_status_id(($order_detail[0]->id))!=5)
<button type="submit" name="submit" class="btn btn-success"> Update Order Detail</button>
@endif
</form>


                                    </div>
                               </div>



@endif












                        
@endsection