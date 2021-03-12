@extends('front_end/layout')
@section('container')




   
     

<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
  
          <ul class="seq-canvas">

@foreach($banners as $banner)


            <li>
              <div class="seq-model">
   
              </div>      
              <img data-seq src="{{asset('storage/media/banner/'.$banner->image)}}">     
              <div class="seq-title">
                        
               <!-- <h2 data-seq>Men Collection</h2>      <span data-seq></span>       -->
         

                <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                <a data-seq href="{{$banner->banner_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$banner->text}}</a>
              </div>
            </li>
            <!-- single slide item -->
          
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
                 @foreach($categories as $category)
                    <li class=""><a href="#cat{{$category->id}}" data-toggle="tab">{{$category->category_name}}</a></li>
                    @endforeach
              
             
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
     
          
                    <!-- / men product category -->
                    <!-- start women product category -->
                    @foreach($categories as $key => $category)
                    @php
                    $cat_class="";
                    if($key==1){
                      $cat_class="in active"; 
            
                    }else{
                      $cat_class="";
                    }
                    @endphp
                    <div class="tab-pane fade {{$cat_class}} " id="cat{{$category->id}}">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        @if(isset($home_categories_product[$category->id][0]))
                       @foreach($home_categories_product[$category->id]  as $productAttr)

                  
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$productAttr->id)}}"><img src="{{asset('storage/media/'.$productAttr->image)}}" alt="polo shirt img"></a>
                            @if($productAttr->availability==1)  
                            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            @else
                            <h1 class="aa-add-card-btn">Out Of Stock</h1>
                            @endif
                            <figcaption>
                              <h4 class="aa-product-title"><a href="#">{{$productAttr->product_name}}</a></h4>
                            
                              @if($home_product_attribute[$productAttr->id][0]->price_after_tax!='')
                              
                              <span class="aa-product-price"> Rs{{$home_product_attribute[$productAttr->id][0]->price_after_tax}}</span>
                              @else

                              <span class="aa-product-price"> Rs{{$home_product_attribute[$productAttr->id][0]->price}}</span>
                             @endif
                              @if($productAttr->discounted==1)
                            
                      
                        
                              <span class="aa-product-price"><del> Rs {{$home_product_attribute[$productAttr->id][0]->mrp}}</del></span>
                              @endif
                            </figcaption>
                          </figure>                         
                      
                          <!-- product badge -->
                          @if($productAttr->discounted==1)
                          @php

                          if($home_product_attribute[$productAttr->id][0]->price_after_tax!='')
                          {
                            $pricesell=$home_product_attribute[$productAttr->id][0]->price_after_tax;
                       
                          }else{
                            $price_after_tax=0;
                            $pricesell=$home_product_attribute[$productAttr->id][0]->price;
                          }

                        $mrtp=$home_product_attribute[$productAttr->id][0]->mrp;
                       
                            $dis=$mrtp-$pricesell;
                            $dicount_per=($dis/$mrtp)*100;
                            $dicount_per=ceil($dicount_per);
                              @endphp
                          <span class="aa-badge aa-sale" href="#">    SALE {{$dicount_per}} % Off</span>
                          @endif
                        </li>
                        @endforeach
                             @else   
                             <li>
                          <figure>
                         
                            <figcaption>
                       
                           
                            </figcaption>
                          </figure>                         
                          <h4 class="aa-product-title"><a href="#">No Product Found In {{$category->category_name}} category</a></h4>
                          <!-- product badge -->
                  
                        </li>
                              @endif
                       
                        <!-- start single product item -->
                  
                        <!-- start single product item -->
                  
                        <!-- start single product item -->
                         
                      </ul>
                   
                    </div>
                    @endforeach
                              
                    <!-- / women product category -->
                    <!-- start sports product category -->
               
                    <!-- / sports product category -->
                    <!-- start electronic product category -->
                
                    <!-- / electronic product category -->
                  </div>
                  <!-- quick view modal -->                  
                 
                 
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
            <div class="aa-banner-area">
            <a href="#"><img src="{{('front_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
          
                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                      
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
              
                     <!-- start single product item -->
        
                    <!-- start single product item -->
                    @if(isset($home_featured_product[0]))
                    @foreach($home_featured_product as $key => $list) 
                  
                    <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$list->id)}}"><img src="{{asset('storage/media/'.$list->image)}}"></a>
                            <a class="aa-add-card-btn" href="{{url('product/'.$list->id)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$list->id)}}">{{$list->product_name}}</a></h4>
                              @if($home_product_featured_attribute[$list->id][0]->price_after_tax!='')
                              
                              <span class="aa-product-price"> Rs{{$home_product_featured_attribute[$list->id][0]->price_after_tax}}</span>
                              @else

                              <span class="aa-product-price"> Rs{{$home_product_featured_attribute[$list->id][0]->price}}</span>
                             @endif
                             @if($list->discounted==1)
                              <span class="aa-product-price">
                              <del>Rs  {{$home_product_featured_attribute[$list->id][0]->mrp}} </del></span>
                              @endif
                            </figcaption>
                          </figure> 
                          @if($list->discounted==1)
                          @php
                          if($home_product_featured_attribute[$list->id][0]->price_after_tax!='')
                          {
                            $pricesell=$home_product_featured_attribute[$list->id][0]->price_after_tax;
                       
                          }else{
                            $price_after_tax=0;
                            $pricesell=$home_product_featured_attribute[$list->id][0]->price;
                          }

                        $mrtp=$home_product_featured_attribute[$list->id][0]->mrp;
                       
                            $dis=$mrtp-$pricesell;
                            $dicount_per=($dis/$mrtp)*100;
                            $dicount_per=ceil($dicount_per);


                  @endphp
                          <span class="aa-badge aa-sale" href="#">SALE  {{$dicount_per}}  % Off</span>
                          @endif                         
                        </li>  
                 
                 @endforeach
                  @else
                             <li>
                      
                          <li>
                          <figure>
                           
                              <h4 class="aa-product-title"><a href="javascript:void(0)">No Featured Product</a></h4>
                             
                          </figure>                          
                        </li>  
                        @endif
                          <!-- product badge -->
                  
                        
                    <!-- start single product item -->
          
                    <!-- start single product item -->
         
                    <!-- start single product item -->
               
                    <!-- start single product item -->
                                                                                        
                  </ul>
               
                </div>
                <!-- / popular product category -->
                
                <!-- start featured product category -->
                
                <!-- / latest product category -->              
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
  <!-- Testimonial -->
  <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
      
              <!-- single slide -->
       
               <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-3.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->

  <!-- Latest Blog -->
  <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>LATEST BLOG</h2>
            <div class="row">
              <!-- single latest blog -->
   
              <!-- single latest blog -->
         
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('front_assets/img/promo-banner-1.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              <!--single-blog-->
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section>
  <!-- / Latest Blog -->

  <!-- Client Brand -->

  @php
  $total_brand=count($brands);
  @endphp
  @if($total_brand>0)
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
                 @foreach($brands as $brand)
                   @if($brand->show_at_home==1 && $brand->status==1 ) 
                   @if($brand->brand_image!='')                
                   <li><a href="#"><img  src="{{asset('storage/media/brand/'.$brand->brand_image)}}" alt="wordPress img"></a></li>
                
                  @endif
                  @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  <!-- / Client Brand -->

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
@endsection