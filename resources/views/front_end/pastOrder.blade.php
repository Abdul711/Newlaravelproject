
  <!-- / menu -->  
  @extends('front_end/layout')
  @section('page_title','Past Order')
@section('container')
  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->


  <!-- / menu -->  

  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                 <th>S.No</th>
                        <th>Order Id</th>
                        <th>Final Price</th>
                        <th>Payment Method</th>
                        <th>Discount</th>
                        <th>Date/Time</th>
                        <th>Order Status</th>
              
                      </tr>
                    </thead>
                             
      <tbody>
                 
                    
                    @foreach($orders as $key => $order)
@php

                $payment=$order->customer_payment;
                if($payment=="Wallet" && 	$order->remaining_amount>0){
                  $payment_method="COD & Wallet";
                }else{
                  $payment_method=$payment;
                }
@endphp
                    
                       
                      <tr>
                      <td>{{$key+1}}</td>
                      <td class="{{$class_ta}}">
                      
                      
                      
                      
                     <p> ORD-{{$order->id}}</p>
                      
                      <a href="{{url('/print_invoice/'.$order->id)}}" class="btn btn-primary m-5">Print Invoice </a>
                      <a href="{{url('/view_detail/'.$order->id)}}" class="btn btn-warning m-5">View Detail
                 </a>
                <a href="javascript:void()" class="btn btn-primary" onclick="readd('{{$order->id}}')"><span class="fa fa-shopping-cart"></span> Add To Cart </a> 
                      
                      </td>
                      <td class="{{$class_ta}}">{{$order->final_price}} Rs </td>
                      <td class="{{$class_ta}}">{{$payment_method}}</td>
                    @if($order->coupon_value>0)
                      <td class="{{$class_ta}}">
                   <p> Discount {{$order->coupon_value}} Rs </p>
                   <p> Coupon: <p>{{$order->coupon_code}}</p> </p>  
                      </td>
                      @else
                           <td class="{{$class_ta}}">No Discount Applied</td>           
                      @endif
                      <td class="{{$class_ta}}">{{date('d-M-Y',strtotime($order->created_at))}}
                      <p>{{date('h:i a',strtotime($order->created_at))}}</p>
                      </td>
                 
                     @if($order->orders_status==1)
                      <td>
                      Pending
                      <p><a href="{{url('/cancel/'.$order->id)}}" class="btn btn-danger">Cancel</a></p>
                      </td>
                      @elseif($order->orders_status==2)
                      <td >
        Confirmed
                      </td>
                      @elseif($order->orders_status==3)
                      <td>
             Hand Over The Rider
                      </td>
                      @elseif($order->orders_status==4)
                      <td >
  Out For Delivery
                      </td>
                      @elseif($order->orders_status==5)
                      <td>
Delivered
                      </td>
                      @elseif($order->orders_status==6)
                      <td>
Cancelled
                      </td>
                      @elseif($order->orders_status==7)
                      <td>
Cancelled By You 
                      </td>
                      @endif
     
     </tr>        

               @endforeach
        
         
                      </tbody>
                  </table>
        
                </div>
             </form>

    <div>
    </div>


    
   
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  

  <!-- / Subscribe section -->
@endsection
  <!-- footer -->  

  <!-- footer -->  
