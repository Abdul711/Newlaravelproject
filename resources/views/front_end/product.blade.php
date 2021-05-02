@extends('front_end/layout')
@section('page_title','Category Page')
@section('container')

  <!-- product category -->
<section id="aa-product-category">
   <div class="container">
      <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
            <div class="aa-product-catg-content">
               <div class="aa-product-catg-head">
                  <div class="aa-product-catg-head-left">
                     <form action="" class="aa-sort-form">
                        <label for="">Sort by</label>
               
                        <select name="" onchange="sort_by()" id="sort_by_value">
                           <option value="" selected="Default">Default</option>
                  
                           @if($sort=="name")
                           <option value="name" selected>Product Name</option>
                           @else
                           <option value="name">Product Name</option>
                           @endif
                           @if($sort=="price_desc")
                           <option value="price_desc" selected>Price - Desc</option>
                           @else
                           <option value="price_desc">Price - Desc</option>
                           @endif
                           @if($sort=="price_asc")
                           <option value="price_asc" selected>Price - Asc</option>
                           @else
                           <option value="price_asc">Price - Asc</option>
                           @endif
                        
                           @if($sort=="date")
                           <option value="date" selected>Date</option>
                           @else
                           <option value="date">Date</option>
                           @endif
                        </select>
                     </form>
                     {{$sort_txt}}
                  </div>
                  <div class="aa-product-catg-head-right">
                     <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                     <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                  </div>
               </div>
               <div class="aa-product-catg-body">
                  <ul class="aa-product-catg">
                     <!-- start single product item -->
                     
                     @foreach($category_product as $product)
                     @php
                    $p=$category_product_attributes[$product->id][0]->price;
                    $disc=$product->discount_amount;
                    $dis=$product->is_discounted;
                         if($disc!="" && $dis==1){
                           $discount=floor(($disc/100)*$p);
                         }else{
                           $discount=0;
                         }
              
          $discounted_price=$p-$discount;
                  $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                  @endphp

                     <li>
               
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$product->id)}}">
                            <img src="{{asset('storage/media/'.$product->image)}}" 
                            alt=""></a>
                      
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></h4>
                            
                              @if($product->is_discounted=="1")
                              <span class="aa-product-price">Rs  {{$discounted_price}}</span>
                              <span class="aa-product-price"><del>Rs{{$category_product_attributes[$product->id][0]->price}}</del></span>
                          @else
                          <span class="aa-product-price">Rs{{$category_product_attributes[$product->id][0]->price}}</span>
                            @endif
                            <p>{{average_rating($product->id)}}  <span class="fa fa-star"> ({{total_rating($product->id)}})</span></p>
                            <p> You Will Earn {{@floor($point_amount/100*$discounted_price)}} Points </p>
                            </figcaption>
                          </figure>    
                          @if($product->is_discounted=="1")
                          <span class="aa-badge aa-sale" href="#">SALE {{$product->discount_amount}} %</span>   
                   @endif
                          <div class="aa-product-hvr-content">

                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" 
                    data-toggle="modal" data-target="#quick-view-modal-{{$product->id}}"><span class="fa fa-search"></span></a>
                  </div>
                    
                        </li>  
                      @endforeach
                   
               
                     
                  </ul>
                  @foreach($category_product as $product)
                  @php
                    $p=$category_product_attributes[$product->id][0]->price;
                    $dis=$product->discount_amount;
                    $disc=$product->is_discounted;
                      if($disc==1 && $dis!=""){
                        $discount=$dis;
                      }else{
                        $discount=0;
                      }
                    $discounted_price=($discount/100)*$p;
                 $discounted_price=$p-$discounted_price;
                 $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                        $points=floor(($point_amount/100)*$discounted_price);
                  @endphp
                  <div class="modal fade" id="quick-view-modal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                             
                             
                              
                                
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="{{asset('storage/media/'.$product->image)}}"
                                     data-big-image="{{asset('storage/media/'.$product->image)}}">
                                      <img src="{{asset('storage/media/'.$product->image)}}" width="260px">
                                  </a>                                    
                              
                               
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>{{$product->name}}</h3>

                            Delivery Time:<p class="text-danger"><b>{{$product->lead_time}}</b></p>
                            
                            <div class="aa-price-block">
                      
                            @if($product->is_discounted=="1")
                              <del><span class="aa-product-view-price">Rs {{$category_product_attributes[$product->id][0]->price}}</span>
                              </del>
                              <span class="aa-product-view-price">Rs {{$discounted_price}}</span>
                              @else
                              <span class="aa-product-view-price">Rs {{$category_product_attributes[$product->id][0]->price}}</span>
                              @endif
                              <p>{{average_rating($product->id)}} <span class="fa fa-star"></span> ({{total_rating($product->id)}})</p>
                           You Will Earn {{$points}} Point
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            @if($product->is_discounted=="1")
                            <span class="title-success" href="#">SALE {{$product->discount_amount}} %</span>    
                            @endif
                            <p>{!!$product->desc!!}</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                                 @foreach($category_product_attributes[$product->id] as $size)
                                 <a href="javascript:void(0)" onclick="sizeSelect('{{$size->size_name}}','{{$product->id}}')" class="Siz size_link" id="size_{{$size->size_name}}{{$product->id}}"> {{$size->size_name}}</a>
                                 @endforeach

                              
                            </div>
                            <h4>Color</h4>
                          
                   
                                 @foreach($category_product_attributes[$product->id] as $color)
                                 <a   href="javascript:void(0)"  id="color_{{$color->color_name}}{{$product->id}}" class="productColor  
                                  ColorSize{{$color->size_name}} aa-col-{{strtolower($color->color_name)}}" onclick="selectColor('{{$color->color_name}}','{{$product->id}}')"   ></a>
                                 @endforeach
                      
                     
                     
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="qtyProduct">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
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
                  <!-- quick view modal -->                  
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
            <aside class="aa-sidebar">
               <!-- single sidebar -->
             


               <div class="aa-sidebar-widget">
                  <h3>Category</h3>
                  <ul class="aa-catg-nav">
      
                     @foreach($categories as $category)
                          @php
                          if($category->id == $cat_id){
                            $class_cat="nav_cat_active";
                          }else{
                            $class_cat="";
                          }
                          @endphp

                     <li><a class="{{$class_cat}}" href="{{url('category/'.$category->id)}}">{{$category->category_name}}</a></li>
                     @endforeach
               
                  </ul>
               </div>
           
               <div class="aa-sidebar-widget">
                  <h3>Shop By Price</h3>
                  <!-- price range -->
                  <div class="aa-sidebar-price-range">
                     <form action="">
                        <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                        </div>
                        <span id="skip-value-lower" class="example-val">{{$start_price}}</span>
                        <span id="skip-value-upper" class="example-val">{{$end_price}}</span>
                        <br>
                        <button class="aa-filter-btn" type="button" onclick="sort_price_filter()">Filter</button>
                     </form>
                  </div>
               </div>
               <!-- single sidebar -->
               <div class="aa-sidebar-widget">
                  <h3>Shop By Color</h3>
                  <div class="aa-color-tag">

                  @foreach($product_attributes as $product_att)
                     @foreach($colors[$product_att->id] as $col)     
                     @php
              
                     $colors_product[$col->id]=$col->color_name;
                     @endphp
              
                  @endforeach
                           @endforeach

               
                   @if(count($colors_product)>0)
                   @foreach( $colors_product as $key=> $product)
             
@php
if($color_sort==$product){
  $class_product="selected_color";
}else{
  $class_product="";
}
@endphp
                    <a id="product_color-{{$product}}" class="{{$class_product}} remain aa-color-{{strtolower($product)}} " onclick="ShowProduct('{{$product}}')" href="javascript:void(0)"></a>
        
                    @endforeach
                   @endif
                  
                  </div>
               </div>

            </aside>
         </div>
      </div>
   </div>
</section>
<!-- / product category -->

<input type="hidden" id="qty" value="1"/>
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id"/>
    <input type="hidden" id="color_id" name="color_id"/>
    <input type="hidden" id="pqty" name="pqty"/>
    <input type="hidden" id="product_id" name="product_id"/>           
    @csrf
  </form>  
  <form id="FilterProduct">
    <input type="text" id="search_product" name="filter_product" value=""/>
    </form>
  <form id="categoryFilter">
    <input type="hidden" id="sort" name="sort" value=""/>
    <input type="hidden" id="colors_id" name="color_id" value=""/>
    <input type="hidden" id="filter_price_start" name="filter_price_start" value="{{$start_price}}"/>
    <input type="hidden" id="filter_price_end" name="filter_price_end" value="{{$end_price}}"/>
  </form> 
@endsection