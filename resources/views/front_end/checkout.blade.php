
  
 @extends('front_end/layout')
 @section('page_title','Checkout')
@section('container')
  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <div class="panel panel-default aa-checkout-coupon">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Have a Coupon?
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" >
                        <div class="panel-body">
@php
                    if(session()->has('COUPONCODE')){
                        $class_box1="hide_coupon_box";
                        $class_box2="show_coupon_box";
     
                        
                     
                        }else{
                          $class_box1="show_coupon_box";
                        $class_box2="hide_coupon_box";
                    
                        }
                        @endphp
                        <div class="apply_coupon_box {{$class_box1}} ">
                          <input type="text" placeholder="Coupon Code" class="  aa-coupon-code" id="coupon_code">
                          <input type="submit" value="Apply Coupon" class="aa-browse-btn apply_coupon" >
                          </div>
                        
                          <div class="applied_coupon_box {{$class_box2}} "> 
                       <span style="color:red; font-weight:800">Coupon Code {{session('COUPONCODE')}} Applied Successfully<span>
                       <span class='fa fa-times' onclick='remove_coupon()'></span>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Login section -->
         
                    <!-- Billing Details -->
                   <!-- <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Billing Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="First Name*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Last Name*">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Company name">
                              </div>                             
                            </div>                            
                          </div>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email Address*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Phone*">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3">Address*</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <select>
                                  <option value="0">Select Your Country</option>
                                  <option value="1">Australia</option>
                                  <option value="2">Afganistan</option>
                                  <option value="3">Bangladesh</option>
                                  <option value="4">Belgium</option>
                                  <option value="5">Brazil</option>
                                  <option value="6">Canada</option>
                                  <option value="7">China</option>
                                  <option value="8">Denmark</option>
                                  <option value="9">Egypt</option>
                                  <option value="10">India</option>
                                  <option value="11">Iran</option>
                                  <option value="12">Israel</option>
                                  <option value="13">Mexico</option>
                                  <option value="14">UAE</option>
                                  <option value="15">UK</option>
                                  <option value="16">USA</option>
                                </select>
                              </div>                             
                            </div>                            
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Appartment, Suite etc.">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="City / Town*">
                              </div>
                            </div>
                          </div>   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="District*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>                                    
                        </div>
                      </div>
                    </div>-->
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Shippping Address
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" id="name"  placeholder="Name*" value="{{$customer_name}}">  
                              </div>                             
                            </div>
                         
                          </div> 
                   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
  
                                <input type="email" id="email"  placeholder="Email Address*" value="{{$customer_email}}">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" id="phone"   placeholder="Phone*" value="{{$customer_mobile}}">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" id="address"   rows="3" placeholder="Address *"></textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <select id="city">  
                                  <option value="0">Select Your City</option>
                                  <option value="1" >Lahore</option>
                                  <option value="2" selected>Karachi</option>
                            
                                </select>
                              </div>                             
                            </div>                            
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Appartment, Suite etc.">
                              </div>                             
                            </div>
                          
                          </div>   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" id="dis" placeholder="District*" value="East">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" id="zip" placeholder="Postcode / ZIP*"  value="1222">
                              </div>
                            </div>
                          </div> 
                           <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3">Special Notes</textarea>
                              </div>                             
                            </div>                            
                          </div>              
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
               You  Will Earn  {{total_point()}}  Points
            
                  @foreach($cart_datas as $cart_data)
                  @php
                 $catName= CategoryName($cart_data['sub_category_id']);
                 if($cart_data['is_discounted']=="1"){
            $dis=(($cart_data['discount_amount']/100)*$cart_data["product_price"]);
              }
              else{
                $dis=0;
              }
              $price=$cart_data['product_price']-$dis;
                  @endphp
              <p class="checkout_box">
Product Name:<b>{{$cart_data["name"]}}</b><br>
@if($cart_data["product_sizes"]!="")
Size:<b>{{$cart_data["product_sizes"]}}</b><br>
@endif
@if($cart_data["product_colors"]!="")
Color:<b>{{$cart_data["product_colors"]}}</b><br>
@endif
                        <a href="#"><img src="{{asset('storage/media/'.$cart_data['product_image'])}}"
                         alt="img" width="150px"></a><br>
                         Brand:<b>{{$cart_data["product_brands"]}}</b><br>
                        Category:<b>{{$cart_data["product_category"]}}</b><br>
                        Sub Category:<b> {{$catName}}</b><br>
                         Per Unit:<b>{{$price}} Rs</b><br>
                         Qty:<b>{{$cart_data["qty"]}}</b><br>
                         <strong>Total:</strong><b>{{ $price * $cart_data['qty']}} Rs </b>
                   </p>
                         
                       
                @endforeach
                       
                       
                    @php
                    $pr="";
                    if($COUPONID >= 1){
      
            $pr="coupon_show";
                    }else{
                      $pr="coupon_hide";
                    }
              if($delivery_charge==0){
                $delivery_charge_text="Free Delivery";
              }else{
                $delivery_charge_text=$delivery_charge."Rs";
              }
@endphp
                     
                  
                      
        
                <p class="checkout_box cart_price "> Coupon Code :<span class="couponcode">{{$COUPONCODE}}</span</p>
            <p class="checkout_box cart_price cart_total"> Cart Total :{{$cart_total}} Rs</p>
            <p class="checkout_box cart_price  cart_promo {{$pr}}" hidden="false">  Cart Total After Promotion :<span class="after_promo">{{$cart_after}}</span> Rs</p>
            <p class="checkout_box cart_price cart_promo {{$pr}}" hidden="false">  Discount :<span class="discount">{{$discount}}</span> Rs</p>
            <p class="checkout_box cart_price " hidden="false">  GST ( <span class="tax_per">{{$tax}}</span> %):<span class="tax_amt">{{$gst}}</span> Rs</p>
            <p class="checkout_box cart_price"> Delivery Charge :<span class="delivery_charge">{{$delivery_charge_text}}</span></p>
            <p class="checkout_box cart_price"> Final Total :<span class="final_price">{{$final_price}}</span>Rs</p>
                  </div>
          <h4>Delivery Type</h4>
                  <div class="aa-payment-method">       
                               
                  <label for="paypal"><input type="radio" class="delivery_type"  id="scheduled" name="deliveryType" value="scheduled">   Scheduled </label>
                   
                  <label for="paypal"><input type="radio" class="delivery_type"  id="express" name="deliveryType" value="express" checked="checked">  Express </label>
                       <span class="delivery_select" style="display:none;">

                        <input type="datetime-local" id="delivery_ti">
                        </span>
                  </div>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">       
                               
             
                   
                               @php 
                               if($final_price < $wallet_amt && $wallet_amt > 0 ){
                                 $check="checked";
                                $dis=""; 
                                $msg="";
                               }else{
                                 $check="";
                                 $dis="disabled";
                                 $msg="Low Wallet";
                               }
                               if($final_price > $wallet_amt){
                                 $checke="checked";
                               }else{
                                 $checke="";
                               }
                               @endphp
                               <label for="cashdelivery">
                               <input type="radio" id="cashdelivery" name="optionsRadios" value="COD" {{$checke}}> Cash on Delivery </label>
                                 <label for="cashdelivery">
                                 <input type="radio" id="wallet" name="optionsRadios" class="wallet" value="Wallet" {{$check}} {{$dis}}> Wallet <span class="wallet">({{$wallet_amt}}</span> Rs) <span class="wallet_msg">{{$msg}}</span></label>
                                 <label for="paypal"><input type="radio" id="paypal" name="optionsRadios" value="paypal"> Via Paypal </label>
                                 <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">    
                                 <input type="submit" value="Place Order" class="aa-browse-btn place_order">                
                               </div>

                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <form id="orderSubmit"> 
  <input type="text" name="customer_name" id="customer_name">
  <input type="text" name="customer_email" id="customer_email">
  <input type="text" name="customer_address" id="customer_address">
  <input type="text" name="customer_phone" id="customer_phone">
  <input type="text"  name="city" id="customer_city">
  <input type="text" name="district" id="customer_dis">
  <input type="text" name="zipcode"id="customer_zip">
  <input type="text" name="total_price" id="cart_total" value="{{$cart_total}}">
  <input type="text" name="final_price" id="final_price" value="{{$final_price}}">
  <input type="text" name="coupon_code" id="coupon_id" value="{{$COUPONCODE}}">
  <input type="text" name="coupon_value" id="coupon_value" value="{{$discount}}">
  <input type="text" name="customer_payment" id="customer_payment">
  <input type="text" name="customer_id" value="{{$user_id}}">
  <input type="text" name="orders_status" value="1">
  <input type="text" name="gst" id="gst" value="{{$gst}}">
  <input type="text" name="delivery_charge" id="delivery_charge" value="{{$delivery_charge}}">  
  <input type="text" name="delivery_type" id="delivery_type" value="">  
  <input type="text" name="delivery_time" id="delivery_time" value="">  
  @csrf
  </form>
@endsection
  <!-- footer -->  
