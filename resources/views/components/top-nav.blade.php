
<div class="aa-cartbox">

                <a class="aa-cart-link" href="#" id="cartBox">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>

                  <span class="aa-cart-notify">{{$total_item}}</span>
                </a>

                <div class="aa-cartbox-summary">
              
                
                  <ul>
                  
                @if($total_item>0)
                  @foreach($cart_datas as $cart_data)

                  @php
              if($cart_data['is_discounted']=="1"){
             $dis=(($cart_data['discount_amount']/100)*$cart_data['product_price']);
              }
              else{
                $dis=0;
              }
              $price=$cart_data['product_price']-$dis;
              @endphp

                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="{{asset('storage/media/'.$cart_data['product_image'])}}" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">{{$cart_data['name']}}</a></h4>
                        <p>
                  <b>Color</b> : <strong>  {{$cart_data['product_colors']}}</strong><br>
                  <b>Size</b> : <strong>  {{$cart_data['product_sizes']}}</strong><br>
   
                        </p>
                        <p>{{$cart_data['qty']}} * Rs {{$price}}</p>
                      </div>
                    </li>
                    @endforeach
                         
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        Rs <span class="c_p">{{$cart_total}}</span>
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="{{url('/cart')}}">Cart</a>
                  @else
                  <ul>
                  <li>
                      <span class="aa-cartbox-total-title">
                    No Item In cart 
                      </span>
                  
                    </li>
                  </ul>
                  @endif
                
                
                </div>
           
              </div>