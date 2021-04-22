
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
                        <th>Payment Status</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                             
      <tbody>
                 
                    
                    @foreach($orders as $key => $order)

       

                    
                       
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
                      <td class="{{$class_ta}}">{{$order->customer_payment}}</td>
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
                      <td>
                      @if($order->payment_status==1)
                  <p>Payment Paid</p>
                     @else
                     <a>Pay Now </a>
                      @endif
                      </td>
                     @if($order->orders_status==1)
                      <td class="{{$class_ta}}">
                      Pending
                      </td>
                      @elseif($order->orders_status==2)
                      <td class="{{$class_ta}}">
                    Under The Process
                      </td>
                      @elseif($order->orders_status==3)
                      <td class="{{$class_ta}}">
             Hand Over The Rider
                      </td>
                      @elseif($order->orders_status==4)
                      <td class="{{$class_ta}}">
  Out For Delivery
                      </td>
                      @elseif($order->orders_status==5)
                      <td class="{{$class_ta}}">
Delivered
                      </td>
                      @elseif($order->orders_status==6)
                      <td class="{{$class_ta}}">
Cancelled
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
