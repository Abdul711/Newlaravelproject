@extends('front_end/layout')
@section('page_title','Home Page')
@section('container')
@if(count($banners)>0)
<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
      
            @foreach($banners as $list)     
            <li>
             
                <img src="{{asset('storage/media/banner/'.$list->image)}}" />
           
              @if($list->text!='')
              <div class="seq-title">
                <a data-seq target="_blank" href="{{$list->banner_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$list->text}}</a>
              </div>
              @endif
            </li>     
            @endforeach
         
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  @endif
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">
                  @foreach($categories as $list)
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{asset('storage/media/category/'.$list->category_image)}}" alt="img">                      
                      <div class="aa-prom-content">
                        <h4><a href="{{url('category/'.$list->id)}}">{{$list->category_name}}</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                 @foreach($categories as $list)
                    <li class=""><a href="#cat{{$list->id}}" data-toggle="tab">{{$list->category_name}}</a></li>
                 @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    @php
                    $loop_count=1;
                    @endphp
                    @foreach($categories as $list)
                    @php
                    $cat_class="";
                    if($loop_count==1){
                      $cat_class="in active"; 
                      $loop_count++;
                    }
                    @endphp
                    <div class="tab-pane fade {{$cat_class}}" id="cat{{$list->id}}">
                      <ul class="aa-product-catg">
                      @if(isset($home_categories_product[$list->id][0]))
                       @foreach($home_categories_product[$list->id] as $productArr)
                    @php
                    $p=$home_product_attributes[$productArr->id][0]->price;
                    $dis=$productArr->discount_amount;
                 $is_dis=$productArr->is_discounted;
                         if($is_dis==1 && $dis!=""){
                           $discount=$dis;
                         }else
                         {
                           $discount=0;
                         }
                         $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                 
                    $discounted_price=($discount/100)*$p;
                $discounted_price=$p-$discounted_price;
            $product_points=floor($point_amount/100*$discounted_price);
                   @endphp
                
               
                        <li>
                          <figure>
                          <a class="aa-product-img" href="{{url('product/'.$productArr->id)}}">
                            <img src="{{asset('storage/media/'.$productArr->image)}}" 
                            alt=""></a>
                        
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->id)}}">{{$productArr->name}}</a></h4>
                        
                              
                              @if($productArr->is_discounted=="1")
                              <del>    <span class="aa-product-price">Rs {{$home_product_attributes[$productArr->id][0]->price}}
                              </span></del>
                              <span class="aa-product-price">Rs {{$discounted_price}}</span> 
                              @else
                              <span class="aa-product-price">Rs {{$home_product_attributes[$productArr->id][0]->price}}
                              </span>
                                                           @endif
                                                           <p>{{average_rating($productArr->id)}}<span class="fa fa-star">
                                                           ({{total_rating($productArr->id)}})
                                                           
                                                           </span></p>        
                                                           <p>You Will Earn {{$product_points}} Points </p>            
                            </figcaption>
                          </figure>   
                          <div class="aa-product-hvr-content">

<a href="#" data-toggle2="tooltip" data-placement="top"  
data-toggle="modal" data-target="#quick-view-modal-{{$productArr->id}}"><span class="fa fa-search"></span></a>
</div>   
@if($productArr->is_discounted=="1")
<span class="aa-badge aa-sale" href="#">SALE {{$productArr->discount_amount}} % </span> 
@endif                   
                        </li>  
                        @endforeach 
                        @foreach($home_categories_product[$list->id] as $product)
                        @php
                    $p=$home_product_attributes[$product->id][0]->price;
                    $dis=$product->discount_amount;
                    $di=$product->is_discounted;
                                 if($di==1 && $dis!=""){
                                   $discount=$dis;
                                 }else{
                                   $discount=0;
                                 }
               $discounted_price=($discount/100)*$p;
                $discounted_prices=$p-$discounted_price;
                   @endphp
     <div class="modal fade" 
     id="quick-view-modal-{{$product->id}}" 
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
     <div class="modal-content">                      
     <div class="modal-body">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <div class="row">
                        <!-- Modal view slider -->
    <div class="col-md-6 col-sm-6 col-xs-12">                              
    <div class="aa-product-view-slider">                                
    <div class="simpleLens-gallery-container" id="demo-1">
    <div class="simpleLens-container">
    <div class="simpleLens-container">
    <a class="simpleLens-lens-image" data-lens-image="{{asset('storage/media/'.$product->image)}}">
    <img src="{{asset('storage/media/'.$product->image)}}" class="simpleLens-big-image">
    </a>
   </div>
   </div>


      
            
            </div>  </div></div>
                        
                       
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>{{$product->name}}</h3>
                            <div class="aa-price-block">
                     
                              @if($product->is_discounted=="1")
                            <del>  <span class="aa-product-view-price">Rs {{$home_product_attributes[$product->id][0]->price}}</price></del>
                            <span class="aa-product-view-price">Rs {{$discounted_prices}}</span>
                         
                             @else
                             <span class="aa-product-view-price">Rs {{$home_product_attributes[$product->id][0]->price}}</price>
                              @endif
                              <p>{{average_rating($product->id)}}<span class="fa fa-star"></span>({{total_rating($product->id)}})</p>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                              @if($product->is_discounted=="1")
                              <span class="title-success" href="#">SALE {{$product->discount_amount}}%</span> 
                              @endif   
                              @php
                              $web=webSetting();
                        
                           $point_amount=$web[0]->point_amount;
                         $product_points=floor($point_amount/100*$discounted_prices);
                              @endphp
                              <p>You Will Earn {{$product_points}} Points </p>
                              <p> <h4>Brands</h4> <p>
                              <p> <h1 class="text-danger">{{$product->brands}}</h1> <p>
                              <p> <h4>Delivery Span</h4> <p>
                              <p> <h1 class="text-danger">{{$product->lead_time}}</h1> <p>
                            </div>
                            <p>{!!$product->desc!!}</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                                 @foreach($home_product_attributes[$product->id] as $size)


                                @php




                                @endphp
                       @endforeach

                       @foreach($home_product_attributes[$product->id] as $size)
                                 <a href="javascript:void(0)" onclick="sizeSelect('{{$size->size_name}}','{{$size->product_id}}')" class="Siz size_link" id="size_{{$size->size_name}}{{$product->id}}"> {{$size->size_name}}</a>
                           @endforeach
                            </div>
                            <h4>Color</h4>
                            <div class="aa-col-tag">
                            @foreach($home_product_attributes[$product->id] as $color)
                                       
                                 <a   href="javascript:void(0)"  id="color_{{$color->color_name}}{{$product->id}}" class="productColor  
                                  ColorSize{{$color->size_name}} aa-col-{{strtolower($color->color_name)}}" onclick="selectColor('{{$color->color_name}}','{{$product->id}}')"   ></a>
                            
                            @endforeach

                                 </div>
                       
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="qtyProduct">
                                  <option value="1" selected="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">{{$list->category_name}}</a>
                              </p>
                            </div>
                           <div class="aa-prod-view-bottom">
                              <a href="javascript:void(0)" onclick="qtyTake('{{$product->id}}')" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                           
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
@endforeach





                        @else
                        <li>
                          <figure>
                            No data found
                          <figure>
                        <li>
                        @endif
                      </ul>
                    </div>
                    @endforeach
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
 

  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
           
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
         
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  
  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach($brands as $list)
              <li><a href="#"><img src="{{asset('storage/media/brand/'.$list->brand_image)}}" alt="{{$list->brands}}"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->
  <input type="hidden" id="qty" value="1"/>
  <form id="frmAddToCart">
    <input type="text" id="size_id" name="size_id" value=""/>
    <input type="text" id="color_id" name="color_id" value=""/>
    <input type="text" id="pqty" name="pqty"/>

    <input type="text" id="product_id" name="product_id" value=""/>    
      
    @csrf
  </form>               
@endsection