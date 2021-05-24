@extends('front_end/layout')
  @section('page_title','Order Detail')
@section('container')
  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->

 <!-- Cart view section -->

 <section id="cart-view">
 
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
        <h1 style="text-align:center;">  Your Order Invoice</h1>
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
         <?php
echo DNS2D::getBarcodeHTML('$orders[0]-id', 'QRCODE');?>
               <diV>
               <div class="aaa-logo">
                <!-- Text based logo -->
                <a href="{{url('/')}}">
                  <span class="fa fa-shopping-cart"></span>
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="javascript:void(0)"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <br><br><br>
         Customer Name: {{$orders[0]->customer_name}}<br>
         Customer Email: {{$orders[0]->customer_email}}<br>
         Customer Mobile: {{$orders[0]->customer_phone}}<br>
         Delivery Address: {{$orders[0]->customer_address}}<br>
               @php
              $payment=$orders[0]->customer_payment;
              if($payment=="Wallet" && $orders[0]->remaining_amount>0){
                $payment_method="COD & Wallet";
              }else{
                $payment_method=$payment;
              }
               @endphp
         Payment Method: {{$payment_method}}<br>
         Delivery Method: {{$orders[0]->delivery_type}}<br>
         Delivery Expected Time: {{date("d-F-Y h:i a",strtotime($orders[0]->delivery_expected_time))}}<br>
         District: {{$orders[0]->district}}<br>
        Order Date:{{date("d-M-Y",strtotime($orders[0]->created_at))}}<br>
        Order Time:{{date("h:i a",strtotime($orders[0]->created_at))}}<br>
         @php
         if($orders[0]->city=="2"){
           $city_name="Karachi";
         }else{
           $city_name="Lahore";
         }
         @endphp
         City:{{$city_name}}<br>
         @if($orders[0]->payment_status==0)
         <p><a>Payment Pending</a> PayNow</p>
@else
<a>Payment Paid</a><br>
         @endif
         Order No: {{$orders[0]->id}}<br>
         <a href="{{url('/print_invoice/'.$orders[0]->id)}}" class="btn btn-primary m-5">Print Invoice </a>
         </div>
        
                <h1 style="text-align:center;">  Cart Details </h1>
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                  
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    
                    <tbody>
              @foreach($order_details as $order_detail)
            
                      <tr> 
                   

                        <td ><a href="#"><img src="{{asset('storage/media/'.$order_detail->image)}}" width="300" height="" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$order_detail->name}}</a>
                        <p>
                       @if($order_detail->color_name!="")
               <b>Color</b> :{{$order_detail->color_name}} <strong>  <br>
               @endif
              @if($order_detail->size_name!="")
                  <b>Size</b> : <strong> {{$order_detail->size_name}} </strong><br>
                  @endif
                  <b>Category</b> : {{$order_detail->category_name}} <strong></strong>
                        </p>
                       <?php echo DNS1D::getBarcodeSVG( "ProductId-".$order_detail->product_id, 'C39');?>
                        </td>
                         <td >Rs {{$order_detail->price}}  </td>  
                         <td>  {{$order_detail->qty}}  </td>
                         <td> <p > {{$order_detail->price * $order_detail->qty}} Rs</p></td>
                      </tr>
                   @endforeach
              
         
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
@php
         
             @endphp

             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th> Cart Total</th>
                     <th class="cart_tota">{{$orders[0]->total_price}}Rs</td>
                   </tr>
                   <tr>
                     <th>Gst</th>
                     <td class="gs">{{$orders[0]->gst}}Rs</td>
                   </tr>
                   <tr>
                   @php
                  if($orders[0]->delivery_charge==0){
$delivery_charge_text="Free Delivery";
                  }else{
                    $delivery_charge_text=$orders[0]->delivery_charge."Rs";
                  }
                   @endphp
                     <th>Delivery Charge</th>
                     <td class="deliver">{{$delivery_charge_text}}  </td>
                   </tr>
                 @if($orders[0]->coupon_value>0)
                 <tr>
                     <th>Discount</th>
                     <td class="deliver">{{$orders[0]->coupon_value}} Rs </td>
                   </tr>
                   <tr>
                     <th>Coupon Code</th>
                     <td class="deliver">{{$orders[0]->coupon_code}} </td>
                   </tr>
                 @endif
                   <tr>
                     <th> Final Total  </th>
                     <td class="final">{{$orders[0]->final_price}}  Rs </td>
                   </tr>
                 </tbody>
               </table>
               </div>
  
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

 </section>
 <!-- / Cart view section -->





  <!-- / Subscribe section -->
@endsection