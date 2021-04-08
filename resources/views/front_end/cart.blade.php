
  <!-- / menu -->  
  @extends('front_end/layout')
  @section('page_title','Cart Page')
@section('container')
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
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($total_item>0)                   
                  @foreach($cart_datas as $cart_data)

              @php
              if($cart_data->is_discounted=="1"){
            $dis=(($cart_data->discount_amount/100)*$cart_data->product_price);
              }
              else{
                $dis=0;
              }
              $price=$cart_data->product_price-$dis;
              @endphp
                      <tr id="box{{$cart_data->attribute_id}}"> 
                        <td><a class= href="javascript:void(0)">  <fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="{{asset('storage/media/'.$cart_data->product_image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$cart_data->name}}</a>
                        <p>
                  <b>Color</b> : <strong>  {{$cart_data->product_colors}}</strong><br>
                  <b>Size</b> : <strong>  {{$cart_data->product_sizes}}</strong><br>
                  <b>Brand</b> : <strong>  {{$cart_data->product_brands}}</strong><br>
                  <b>Category</b> : <strong>  {{$cart_data->product_category}}</strong>
                        </p>
                        
                        </td>

                         <td>Rs {{$price}}  </td>  
                         <td><input type="number" id="qty{{$cart_data->attribute_id}}"  class="aa-cart-quantity" onchange="updateCart('{{$cart_data->product_colors}}','{{$cart_data->product_sizes}}','{{$cart_data->cart_product_id}}','{{$cart_data->attribute_id}}','{{$price}}')" value="{{$cart_data->qty}}" min="0"> </td>
                         <td> <p id="price{{$cart_data->attribute_id}}"> Rs {{($cart_data->qty) * ($price)}} <p> </td>
                      </tr>
                      @endforeach
                      @else
                    <tr>
                    <td colspan="6"> No Product In Cart</td>
                 </tr>
                 @endif
                 <tr id="no" style="display:none;">
                    <td colspan="6"> No Product In Cart</td>
                 </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
@php
           $cart=cartTotal();
    
           extract($cart);
             @endphp

             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th> Cart Total</th>
                     <th class="cart_total"> {{$cart_total}} Rs</td>
                   </tr>
                 @php
                 if($delivery_charge>0){
                   $delivery_charge_text=$delivery_charge." Rs ";
                 }else{
                  $delivery_charge_text="Free Delivery";
                 }
                 @endphp             
                 <tr>
                     <th>Delivery Charge</th>
        
                     <td ><span class="delivery_charge">{{$delivery_charge_text}}</span></td>
                   </tr>
                   <tr>
                     <th>Gst</th>
        
                     <td ><span class="gst">{{$gst}} Rs</span></td>
                   </tr>
                   <tr>
                     <th>Final Price</th>
        
                     <td ><span class="final">{{$final_price}} Rs</span></td>
                   </tr>
                 </tbody>
               </table>
               </div>
       @if($total_item>0)
    
       
               <a href="{{urL('/checkout')}}" class="aa-cart-view-btn checkout">Proced to Checkout</a>

               @endif
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <form id="frmAddToCart">
    <input type="text" id="size_id" name="size_id" value=""/>
    <input type="text" id="color_id" name="color_id" value=""/>
    <input type="text" id="pqty" name="pqty"/>

    <input type="text" id="product_id" name="product_id" value=""/>    
      
    @csrf
  </form>
  <!-- / Subscribe section -->
@endsection
  <!-- footer -->  
