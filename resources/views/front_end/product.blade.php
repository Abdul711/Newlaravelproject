@extends('front_end/layout')

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
                           <option value="name">Name</option>
                           <option value="price_desc">Price - Desc</option>
                           <option value="price_asc">Price - Asc</option>
                           <option value="date">Date</option>
                        </select>
                     </form>
                
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
                     <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$product->id)}}">
                            <img src="{{asset('storage/media/'.$product->image)}}" 
                            alt=""></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="
                            home_add_to_cart('',
                            '','')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></h4>
                              <span class="aa-product-price">Rs{{$category_product_attributes[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs{{$category_product_attributes[$product->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>    

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
                              <div class="simpleLens-container">
                             
                             
                              
                                  <div class="simpleLens-container">
                                      <a class="simpleLens-lens-image" data-lens-image="{{asset('storage/media/'.$product->image)}}">
                                          <img src="{{asset('storage/media/'.$product->image)}}" width="100px" class="simpleLens-big-image">
                                      </a>
                                  </div>
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
                              <span class="aa-product-view-price">Rs {{$category_product_attributes[$product->id][0]->price}}</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>{!!$product->desc!!}</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                                 @foreach($category_product_attributes[$product->id] as $color)
                                 <a href="#"> {{$color->size_name}}</a>
                                 @endforeach

                              
                            </div>
                            <h4>Color</h4>
                          
                   
                                 @foreach($category_product_attributes[$product->id] as $color)
                           
                                 @endforeach
                                 <div class="aa-col-red" id="a-color-red"></div>
                     
                     
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                           <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                           
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
                     <li><a href="{{url('category/'.$category->id)}}">{{$category->category_name}}</a></li>
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
                        <span id="skip-value-lower" class="example-val">30.00</span>
                        <span id="skip-value-upper" class="example-val">100.00</span>
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

                   {{count($colors_product)}}
                   @if(count($colors_product)>0)
                   @foreach( $colors_product as $key=> $product)
                    <a class="aa-color-{{strtolower($product)}}" href="#"></a>
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

  <form id="categoryFilter">
    <input type="hidden" id="sort" name="sort" value=""/>
    <input type="hidden" id="filter_price_start" name="filter_price_start" value=""/>
    <input type="hidden" id="filter_price_end" name="filter_price_end" value=""/>
  </form> 
@endsection