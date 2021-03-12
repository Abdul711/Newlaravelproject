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
                              <h4 class="aa-product-title"><a href="{{url('product/'.$product->id)}}">{{$product->product_name}}</a></h4>
                              <span class="aa-product-price">Rs{{$category_product_attributes[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs{{$category_product_attributes[$product->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>                          
                        </li>  
                      @endforeach
                   
               
                     
                  </ul>
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

                  
                   @foreach( $colors_product as $key=> $product)
                    <a class="aa-color-{{strtolower($product)}}" href="#"></a>
                    @endforeach
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