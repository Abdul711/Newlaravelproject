@extends('front_end/layout')
@section('page_title','Search')
@section('container')

  <!-- product category -->
<section id="aa-product-category">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-8">
            <div class="aa-product-catg-content">
               <div class="aa-product-catg-body">
                  <ul class="aa-product-catg">
                     <!-- start single product item -->
                     
                     @if(isset($search_product[0]))
                       @foreach($search_product as $productArr)
                      @php
                      $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;     
                   $product_price=$product_attributes[$productArr->id][0]->price;
                   if($productArr->is_discounted==1 && $productArr->discount_amount!=""){
                   $discount=floor(($productArr->discount_amount/100)*$product_price);
                   }else{
                     $discount=0;
                   }
                   $discounted_product=$product_price-$discount;
                      @endphp

                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$productArr->id)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                          
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->id)}}">{{$productArr->name}}</a></h4>
                              @if($productArr->is_discounted=="1")
                              <span class="aa-product-price">Rs {{$discounted_product}}</span>
                              <span class="aa-product-price"><del>Rs {{$product_attributes[$productArr->id][0]->price}}</del></span>
                              @else
                              <span class="aa-product-price">Rs {{$product_attributes[$productArr->id][0]->price}}</span>
                              @endif
                              <p>{{average_rating($productArr->id)}}  <span class="fa fa-star"> ({{total_rating($productArr->id)}})</span></p>
                            <p> You Will Earn {{@floor($point_amount/100*$discounted_product)}} Points </p>   
                            </figcaption>
                          </figure>            
                          <div class="aa-product-hvr-content">

<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" 
data-toggle="modal" data-target="#quick-view-modal-{{$productArr->id}}"><span class="fa fa-search"></span></a>
</div>
                        </li>  
                        @endforeach    



                        @else
                        <li>
                          <figure>
                            No Product Found
                          <figure>
                        <li>
                        @endif
                                  @foreach($search_product as $product)
                        @php
                        $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                 
                    $p=$product_attributes[$product->id][0]->price;
                    $dis=$product->discount_amount;
                    $discounte=$product->is_discounted;
                    if($discounte==1 && $dis!=""){
                      $discount=$dis;
                    }else{
                      $discount=0;
                    }
                  
                    $discounted_price=($discount/100)*$p;
                  $discounted_price=$p-$discounted_price;
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
                            <del>  <span class="aa-product-view-price">Rs {{$product_attributes[$product->id][0]->price}}</price></del>
                            <span class="aa-product-view-price">Rs {{$discounted_price}}</span>
                         
                             @else
                             <span class="aa-product-view-price">Rs {{$product_attributes[$product->id][0]->price}}</price>
                              @endif
                              <p>{{average_rating($product->id)}}<span class="fa fa-star"></span>({{total_rating($product->id)}})</p>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                              @if($product->is_discounted=="1")
                              <span class="title-success" href="#">SALE {{$product->discount_amount}}%</span> 
                              @endif   
                              <p>You Will Earn {{@floor($point_amount/100*$discounted_price)}} Points </p>
                              <p> <h4>Brands</h4> <p>
                              <p> <h1 class="text-danger">{{$product->brands}}</h1> <p>
                              <p> <h4>Delivery Span</h4> <p>
                              <p> <h1 class="text-danger">{{$product->lead_time}}</h1> <p>
                            </div>
                            <p>{!!$product->desc!!}</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                                 @foreach($product_attributes[$product->id] as $size)


                                @php




                                @endphp
                       @endforeach

                       @foreach($product_attributes[$product->id] as $size)
                       @if($size->size_name!="")
                                 <a href="javascript:void(0)" onclick="sizeSelect('{{$size->size_name}}','{{$size->product_id}}')" class="Siz size_link" id="size_{{$size->size_name}}{{$product->id}}">   {{$size->size_name}} ({{Price($size->product_id,$size->size_name)}} Rs )</a>
                           @else
                           No Size Available
                           @endif
                           @endforeach
                            </div>
                            <h4>Color</h4>
                            <div class="aa-col-tag">
                            @foreach($product_attributes[$product->id] as $color)
                                       @if($color->color_name!="")
                                 <a   href="javascript:void(0)"  id="color_{{$color->color_name}}{{$product->id}}" class="productColor  
                                  ColorSize{{$color->size_name}} aa-col-{{strtolower($color->color_name)}}" onclick="selectColor('{{$color->color_name}}','{{$product->id}}')"   ></a>
                            @else
                            No Color Or Standard Color Available
                            @endif
                            @endforeach

                                 </div>
                       
                            <div class="aa-prod-quantity">
                  
                              <p class="aa-prod-category">
                                Category: <a href="#">{{$product->category_name}}</a>
                              </p>
                            </div>
                           <div class="aa-prod-view-bottom">
                              <a href="javascript:void(0)" onclick="qtyTake('{{$product->id}}','{{$product_attributes[$product->id][0]->color_name}}','{{$product_attributes[$product->id][0]->size_name}}')" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                           
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
@endforeach
                  </ul>
                  <!-- quick view modal -->                  
               </div>
            </div>
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

 
@endsection