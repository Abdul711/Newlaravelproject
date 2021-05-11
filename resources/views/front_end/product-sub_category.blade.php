@extends('front_end/layout')
@section('page_title',$page_title)
@section('container')

  <!-- product category -->
<section id="aa-product-category">
   <div class="container">
      <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
            <div class="aa-product-catg-content">
             
               <div class="aa-product-catg-body">
                  <ul class="aa-product-catg">
                     <!-- start single product item -->
                     
                     @foreach($category_product as $product)
                     <li>
                     @php
                     $price_product=$category_product_attributes[$product->id][0]->price;
                   if($product->is_discounted=="1"){
                     $discount=floor(($product->discount_amount/100)*$price_product);
                   }else{
                     $discount=0;
                   }
                      $discount;
$discount_price=$price_product-$discount;
                     @endphp
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$product->id)}}">
                            <img src="{{asset('storage/media/'.$product->image)}}" 
                            alt=""></a>
                        
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></h4>
                     
                              @if($product->is_discounted=="1")
                              <span class="aa-product-price">Rs {{$discount_price}} </span>
                            <span class="aa-product-price">
                              <del>Rs{{$category_product_attributes[$product->id][0]->price}}</del>
                              </span>   
                              @else
                            
                           <span class="aa-product-price">
                           Rs {{$price_product}}
                            
   
    </span>   
   
                              @endif
                              @php
                              $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                        $point_amount=$point_amount/100;
                        @endphp
                           <p>    You Will Earn {{@floor($point_amount*$discount_price)}} Points </p>
                       <div>{{average_rating($product->id)}}  <span class="fa fa-star"> ({{total_rating($product->id)}})</span>
    <p> </div>

                    
             
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
                            <div class="aa-price-block">
                            @php
                     $price_product=$category_product_attributes[$product->id][0]->price;
                   if($product->is_discounted=="1"){
                     $discount=floor(($product->discount_amount/100)*$price_product);
                   }else{
                     $discount=0;
                   }
                      $discount;
$discount_price=$price_product-$discount;
                     @endphp
                     <div>
                     @php
                     $web=webSetting();
                        
                        $point_amount=$web[0]->point_amount;
                        $point_amount=$point_amount/100;

                        @endphp
    Point You Will Earn {{@floor($point_amount*$discount_price)}} Points
                     </div>
                     @if($product->is_discounted=="1")
                     <span class="aa-product-view-price">Rs {{$discount_price}}</span>
                
                           <del>   <span class="aa-product-view-price">Rs {{$category_product_attributes[$product->id][0]->price}}</span></del>
                              @else
                              <span class="aa-product-view-price">Rs {{$category_product_attributes[$product->id][0]->price}}</span>
@endif

<p>{{average_rating($product->id)}}  <span class="fa fa-star"> ({{total_rating($product->id)}})</span></p>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
  @if($product->is_discounted=="1")
                            <span class="title-success" href="#">SALE {{$product->discount_amount}} %</span>    
           @endif
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                               
                                 @foreach($category_product_attributes[$product->id] as $size)
                                 <a href="javascript:void(0)" onclick="sizeSelect('{{$size->size_name}}','{{$product->id}}')" class="Siz size_link" id="size_{{$size->size_name}}{{$product->id}}"> {{$size->size_name}}</a>
                                 @endforeach
                               

                              
                            </div>
                            <h4>Color</h4>
                            <div class="aa-prod-view-color">
                              

                                 @foreach($category_product_attributes[$product->id] as $color)
                                 <a   href="javascript:void(0)"  id="color_{{$color->color_name}}{{$product->id}}" class="productColor  
                                  ColorSize{{$color->size_name}} aa-col-{{strtolower($color->color_name)}}" onclick="selectColor('{{$color->color_name}}','{{$product->id}}')"   ></a>
                                 @endforeach
                              
                            </div>
                            <div class="aa-prod-quantity">
                      
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                           <div class="aa-prod-view-bottom">
                            <a href="javascript:void(0)" class="aa-add-to-cart-btn" onclick="qtyTake('{{$product->id}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                           
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
                  <h3>Sub Category</h3>
                  <ul class="aa-catg-nav">
                     @foreach($categories as $category)
                   @php
                     if($category->id == $category_id){
                            $class_cat="nav_cat_active";
                          }else{
                            $class_cat="";
                          }
                          @endphp
                     <li><a href="{{url('sub_category/'.$category->id)}}" class="{{$class_cat}}">{{$category->category_name}}</a></li>
                     @endforeach
               
                  </ul>
               </div>
           
            
               <!-- single sidebar -->
         

            </aside>
         </div>
      </div>
   </div>
</section>
<!-- / product category -->

<input type="hidden" id="qty" value="1"/>
  <form id="frmAddToCart">
    <input type="text" id="size_id" name="size_id"/>
    <input type="text" id="color_id" name="color_id"/>
    <input type="text" id="pqty" name="pqty"/>
    <input type="text" id="product_id" name="product_id"/>       

        

    @csrf
  </form>  

  <form id="categoryFilterForm">
    <input type="text" id="sort" name="sort" value=""/>
    <input type="text" id="filter_price_start" name="filter_price_start" value="{{$start_price}}"/>
    <input type="text" id="filter_price_end" name="filter_price_end" value="{{$end_price}}"/>
    <input type="text" id="colors_id" name="color_id" value=""/>
  </form> 
@endsection