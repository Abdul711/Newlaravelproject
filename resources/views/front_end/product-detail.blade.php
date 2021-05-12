
@extends('front_end/layout')
@section('page_title',$product[0]->name)
@section('container')


  <!-- catg header banner section -->
  <!--<section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>T-Shirt</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li><a href="#">Product</a></li>
          <li class="active">T-shirt</li>
        </ol>
      </div>
     </div>
   </div>
  </section>-->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{asset('storage/media/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#"><img src="{{asset('storage/media/'.$product[0]->image)}}" width="70px">
                          </a>   

                          @if(isset($product_images[$product[0]->id][0]))

                            @foreach($product_images[$product[0]->id] as $list)
                            
                            <a data-big-image="{{asset('storage/media/'.$list->images)}}" data-lens-image="{{asset('storage/media/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#"><img src="{{asset('storage/media/'.$list->images)}}" width="70px">
                            </a>  
                            
                            @endforeach

                          @endif
                                                   
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$product[0]->name}}</h3>
               {{$average_rating}} <span class="fa fa-star"></span> ({{total_rating($product[0]->id)}})
                    @php
        
                   $p=$product_attributes[$product[0]->id][0]->price;
                    $dis=$product[0]->discount_amount;
                    $Is_dis=$product[0]->is_discounted;
                               if($Is_dis==1 && $dis!=""){
                                 $discount=($dis/100)*$p;
                               }else{
                                 $discount=0;
                               }
       
                  $discounted_price=$p-$discount;
                  $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                   @endphp
                   @if($product[0]->is_discounted!=0)
                    <div class="title-success">SALE{{$product[0]->discount_amount}}%</div>      
                               @endif
                               <div class="aa-price-block">

                  
                      @if($product[0]->is_discounted!=0)
                      <span class="aa-product-view-price">Rs {{$discounted_price}} &nbsp;&nbsp;</span>
                     <del> <span class="aa-product-view-price">Rs {{$product_attributes[$product[0]->id][0]->price}}</span></del>
                     @else
                     <span class="aa-product-view-price">Rs {{$product_attributes[$product[0]->id][0]->price}}</span>
                       @endif
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                      <p>You Will Earn {{@floor($point_amount/100*$discounted_price)}} Points </p>
                 <p>  Brand: {{$product[0]->brand_name}}</p>
                   
                       <p class="lead_time">
           
                       </p>
                  

                    </div>
                    <p>
        
                    </p>

                    @if($product_attributes[$product[0]->id][0]->size_id>0)
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                    @php
                   
                      foreach($product_attributes[$product[0]->id] as $attr){
          
                    $arrSize[$attr->size_id]=$attr->size_name;
                        
                      }  
           
                    @endphp
             
                  @foreach($arrSize as $key => $value)
             
                      <a href="javascript:void(0)" onclick=showColor("{{$value}}") id="size_{{$value}}" class="size_link">{{$value}}</a>
                  @endforeach
 
                    </div>
                    @endif
                    
                    
                    @if($product_attributes[$product[0]->id][0]->color_id>0)
                    
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                    @foreach($product_attributes[$product[0]->id] as $attr)  
                      @php
                     
                      @endphp
                      @if($attr->color_id!="" && $attr->color_id!=0)
           
                      <a href="javascript:void(0)" class="aa-color-{{strtolower($attr->color_name)}} 
                      colors  color_{{$attr->color_name}} product_color size_{{$attr->size_name}}"  
                      onclick=change_product_color_image("{{$attr->color_name}}","{{$attr->product_id}}")></a>
                      @endif  

                      @endforeach  
                    </div>     
              
                      
                   

              
               

               
                    </div>
                    @endif    

                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="qty" name="qty" >
                        <option value="">Select Qty</option>
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
                        </select>
                      </form>
                      <p class="aa-prod-category">
         
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_cart('{{$product_attributes[$product[0]->id][0]->size_name}}','{{$product_attributes[$product[0]->id][0]->color_name}}')">Add To Cart</a>
                    </div>
                    <div id="add_to_cart_msg"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>

                <li><a href="#review" data-toggle="tab">Reviews</a></li>     
                 
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
          
            {!!$product[0]->desc!!}
                </div>
                <div class="tab-pane fade" id="technical_specification">
                {!!$product[0]->desc!!}
                </div>
                <div class="tab-pane fade" id="uses">
                {!!$product[0]->desc!!}
                </div>
                <div class="tab-pane fade" id="warranty">
                {{$product[0]->warranty}}
                </div>
            
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                 @if(count($user_review)>0)
                   <h4><span class="total_review">{{count($user_review)+3}}</span> Reviews for {{$product[0]->name}} </h4> 
                   @endif
                   <ul class="aa-review-nav">
                    <div id="productR"></div>
                   
                     @if(count($user_review)>0)
                     <li>
                        <div class="media">
                          <div class="media-left">
                    
                          </div>
                          <div class="media-body">
                          <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>
                          {{date('F d , Y',strtotime("-7 days"))}}  {{date('l',strtotime("-7 days"))}}
           
                   </span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                    
                          </div>
                          <div class="media-body">
                          <h4 class="media-heading"><strong>Taha </strong> - <span>
                          {{date('F d , Y',strtotime("-2 months"))}}  {{date('l',strtotime("-2 months"))}}
           
                   </span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                    
                          </div>
                          <div class="media-body">
                          <h4 class="media-heading"><strong>Taha Qadir </strong> - <span>
                          {{date('F d , Y',strtotime("-2 years"))}}  {{date('l',strtotime("-2 years"))}}
           
                   </span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      @endif
                      @if(count($user_review)>0)
                     @foreach($user_review as $user_reviews)
                      <li>
                        <div class="media">
                          <div class="media-left">
                    
                          </div>
                          <div class="media-body">
                          <h4 class="media-heading"><strong>{{$user_reviews->user_name}}</strong> - <span>
                          {{date('F d , Y',strtotime($user_reviews->created_at))}}    {{date('l',strtotime($user_reviews->created_at))}}
                  
                   </span></h4>
                   @php
                $rated=$user_reviews->rating;
                $remaining_rated=5-$user_reviews->rating;
                 @endphp
                            <div class="aa-product-rating">
                            @for($i=1; $i<=$rated; $i++)
                              <span class="fa fa-star"></span>
                              @endfor
                                @if($remaining_rated>0)
                                @for($i=1; $i<=$remaining_rated; $i++)
                              <span class="fa fa-star-o"></span>
                              @endfor
                              @endif
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>{{$user_reviews->review}}</p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                      @else
                      <div class="no_review">
                      <li>
                        <div class="media">
                          <div class="media-left">
                    
                          </div>
                          <div class="media-body">
                          <h4 class="media-heading"><strong></strong><span>
                          No Review
                      </div>
                      </div>
                  
                   </span></h4>
                     </li>       
               </div>
@endif
                   </ul>
                   @if(session()->has('FRONT_USER_ID')!=0 || isset($_COOKIE['CUSTOMER_ID']))
                  @php

            if(in_array($product[0]->id,$order_product)){
            $found=1;
       
            }else{
              $found=0;
     
            }
      
                  @endphp
                @if($found==1)
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     @for($i=1; $i<=5; $i++)
                     <a href="javascript:void(0)"><span id="{{$product[0]->id}}{{$i}}" class="product_rating fa fa-star-o" data-index="{{$i}}" 
                     
                     data-product_id="{{$product[0]->id}}"
                     
                     ></span></a>
           
                @endfor
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit"  class= "su btn btn-default aa-review-submit">Submit</button>
                   </form>
      @endif
            @endif
          
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
               
              @if(isset($related_product[0]))
                    @foreach($related_product as $productArr)
                    @php
                  $product_price=$product_related_attributes[$productArr->id][0]->price;
                     if($productArr->is_discounted==1 && $productArr->discount_amount!=""){
                       $discount=floor(($productArr->discount_amount/100)*$product_price);
                     }else{
                       $discount=0;
                     }
                     $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                     $discounted_price=$product_price-$discount;
              $products_point=floor(($point_amount/100)*$discounted_price);
                    @endphp
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$productArr->id)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                      
                        <figcaption>
                      <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->id)}}">
                            {{$productArr->name}}</a></h4>

  @if($productArr->is_discounted==1)
  <span class="aa-product-price">
 Rs {{$discounted_price}}
                        </span>
  <span class="aa-product-price">
 <del> Rs {{$product_related_attributes[$productArr->id][0]->price}} </del>
  </span>
  @else
  <span class="aa-product-price">
  Rs {{$product_related_attributes[$productArr->id][0]->price}} 
  </span>
  @endif
  <p>  You Will Earn {{$products_point}} Points </p>
                       <div>{{average_rating($productArr->id)}}  <span class="fa fa-star"> ({{total_rating($productArr->id)}})</span>
    <p> </div>
                        </figcaption>
                        </figure>       
                        @if($productArr->is_discounted==1)
                          @php

                    

                       
                       
                        
                        
                              @endphp
                
                          <span class="aa-badge aa-sale" href="#">SALE {{$productArr->discount_amount}} %</span>   
                   @endif
                          
                   <div class="aa-product-hvr-content">

<a href="#" data-toggle2="tooltip" data-placement="top" 
data-toggle="modal" data-target="#quick-view-modal-{{$productArr->id}}"><span class="fa fa-search"></span></a>
</div>



                    </li>  
                    @endforeach    


                    @else
                    <li>
                        <figure>
                        No Product  found
                        <figure>
                    <li>
                    @endif      
                
                                 
              </ul>
  
              @foreach($related_product as $productArr)
                  <div class="modal fade" id="quick-view-modal-{{$productArr->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                     
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="{{asset('storage/media/'.$productArr->image)}}"
                                     data-big-image="{{asset('storage/media/'.$productArr->image)}}">
                                      <img src="{{asset('storage/media/'.$productArr->image)}}" width="260px">
                                  </a>                                    
                              
                               
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>{{$productArr->name}}</h3>
                            <div class="aa-price-block">
                            @php
                     $price_product=$product_related_attributes[$productArr->id][0]->price;
                   if($productArr->is_discounted==1){
                     $discount=floor(($productArr->discount_amount/100)*$price_product);
                   }else{
                     $discount=0;
                   }
                   $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                      $discount;
 $discount_price=$price_product-$discount;
$product_points=floor($point_amount/100*$discount_price);
                     @endphp
                     <div>
                  
   You Will Earn {{$product_points}} Point
                     </div>
                     @if($productArr->is_discounted=="1")
                     <span class="aa-product-view-price">Rs {{$discount_price}}</span>
                
                           <del>   <span class="aa-product-view-price">Rs {{$product_related_attributes[$productArr->id][0]->price}}</span></del>
                              @else
                              <span class="aa-product-view-price">Rs {{$product_related_attributes[$productArr->id][0]->price}}</span>
@endif

<p>{{average_rating($productArr->id)}}  <span class="fa fa-star"> ({{total_rating($productArr->id)}})</span></p>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
  @if($productArr->is_discounted=="1")
                            <span class="title-success" href="#">SALE {{$productArr->discount_amount}} %</span>    
           @endif
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                               
                                
                            @foreach($product_related_attributes[$productArr->id] as $size)
                                @if($size->size_name!="")
                                 <a href="javascript:void(0)" onclick="sizeSelect('{{$size->size_name}}','{{$productArr->id}}')" class="Siz size_link" id="size_{{$size->size_name}}{{$productArr->id}}"> {{$size->size_name}}</a>
                                @else
                                No Size Or Standard Size Available
                  
                                @endif
                                 @endforeach

                              
                            </div>
                            <h4>Color</h4>
                            <div class="aa-prod-view-color">
                              
                            @foreach($product_related_attributes[$productArr->id] as $color)
                                 <a   href="javascript:void(0)"  id="color_{{$color->color_name}}{{$productArr->id}}" class="productColor  
                                  ColorSize{{$color->size_name}} aa-col-{{strtolower($color->color_name)}}" onclick="selectColor('{{$color->color_name}}','{{$productArr->id}}')"   ></a>
                                 @endforeach
                           
                              
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                             
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                           <div class="aa-prod-view-bottom">
                            <a href="javascript:void(0)" class="aa-add-to-cart-btn" onclick="qtyTake('{{$productArr->id}}','{{$product_related_attributes[$productArr->id][0]->color_name}}','{{$product_related_attributes[$productArr->id][0]->size_name}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                           
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
@endforeach


            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id" value=""/>
    <input type="hidden" id="color_id" name="color_id" value=""/>
    <input type="hidden" id="pqty" name="pqty" value=""/>

    <input type="hidden" id="product_id" name="product_id" value="{{$product[0]->id}}"/>    
      
    @csrf
  </form>
  <form id="ReviewAndRating">
    <input type="text" id="rating" name="rating" value=""/>

    <input type="text" id="r" name="review" value=""/>
    <input type="text" id="review_name" name="review_name"/>
    <input type="text" id="review_email" name="review_email"/>
<input type="text" id="pid" name="pid"value="{{$product[0]->id}}">
      
    @csrf
  </form>
@endsection