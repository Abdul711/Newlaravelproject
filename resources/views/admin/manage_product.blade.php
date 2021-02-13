@extends('admin/layout')
@section('page_title',"$page_title")
@section('product_select','active')
@section('container')

<h1 class="mb10">{{$page_title}}</h1>
@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('sku_error')}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@endif 	

@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@enderror

@error('images.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@enderror
@error('name')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div>                   
 @enderror
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
@if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
     @endif  
<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     @csrf
                     <div class="form-group">
                        <label for="name" class="control-label mb-1"> Name</label>
                        <input id="name" value="{{$product_data['product_name']}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                       
                     </div>
               
                     <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" 
                        class="form-control" aria-required="true" aria-invalid="false" >
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                        @if($product_data['image']!='' && $product_data['image']!=null)
                        <a href="{{url('storage/media/'.$product_data['image'])}}"><img src="{{asset('storage/media/'.$product_data['image'])}}" width="100px"></a>
                              @endif
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Category</label>
                              <select id="category_id" name="category_id" class="form-control">
                                 <option value="">Select Category</option>
                                 @foreach($categories as $category)
                             
                             @if($product_data['category_id']==$category['id'])
                            <option value="{{$category['id']}}"selected>{{$category['category_name']}}</option>
                            @else
                            <option value="{{$category['id']}}">{{$category['category_name']}}</option>
                            @endif
                            @endforeach
                              </select>
                             
                           </div>
                           <div class="col-md-4">
                              <label for="brand_id" class="control-label mb-1"> Brand</label>
                              <select id="brand" name="brand" class="form-control" >
                                 <option value="">Select Brand</option>
                             @foreach($brands as $br)
                             
                              @if($product_data['brand_id']==$br['id'])
                             <option value="{{$br->id}}"selected>{{$br->brands}}</option>
                             @else
                             <option value="{{$br->id}}">{{$br->brands}}</option>
                             @endif
                             @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="sub_category_id" class="control-label mb-1"> Sub Category</label>
                              <select id="brand" name="sub_category_id" class="form-control" >
                                 <option value="">Select Sub Category</option>
                                 @foreach($subcategories as $subcategory)
                             
                             @if($product_data['sub_category_id']==$subcategory['id'])
                            <option value="{{$subcategory['id']}}"selected>{{$subcategory['sub_category_name']}}</option>
                            @else
                            <option value="{{$subcategory['id']}}">{{$subcategory['sub_category_name']}}</option>
                            @endif
                            @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                
               

                    

                
                  </div>
               </div>
            </div>
           
            <h2 class="mb10 ml15">Product Attributes</h2>
            <div class="col-lg-12" id="product_attr_box">
                 @foreach($product_attributes as $key => $product_attribute)
               
               <input id="paid" type="hidden" name="paid[]" value="{{$product_attribute['id']}}">
               <div class="card" id="product_attr_1">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-2">
                              <label for="sku" class="control-label mb-1"> SKU</label>
                              <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attribute['sku']}}" required>
                           </div>
                           <div class="col-md-2">
                              <label for="mrp" class="control-label mb-1"> MRP</label>
                              <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attribute['mrp']}}" required>
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price" name="price[]" type="text" class="form-control" aria-required="true" 
                              aria-invalid="false" value="{{$product_attribute['price']}}" required>
                           </div>
                           <div class="col-md-3">
                              <label for="size_id" class="control-label mb-1"> Size</label>
                              <select id="size_id" name="size_id[]" class="form-control">
                                 <option value="">Select </option>
                                 @foreach($sizes as $size)
                                 @if($size['id']==$product_attribute['size_id'])
                                     <option value="{{$size['id']}}"selected>{{$size['size_name']}}</option>
                                     @else
                                     <option value="{{$size['id']}}">{{$size['size_name']}}</option>
                                    @endif
                                    @endforeach
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="color_id" class="control-label mb-1"> Color</label>
                              <select id="color_id" name="color_id[]" class="form-control">
                                 
                                 <option value="">Select</option>
                                 @foreach($colors as $color)
                                 @if($color['id']==$product_attribute['color_id'])
                                     <option value="{{$color['id']}}"selected>{{$color['color_name']}}</option>
                                     @else
                                     <option value="{{$color['id']}}">{{$color['color_name']}}</option>
                                    @endif
                                    @endforeach
                              
                            
                              </select>
                           </div>
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1"> Qty</label>
                              <input id="qty" name="qty[]" type="text" class="form-control"
                               aria-required="true" aria-invalid="false" value="{{$product_attribute['qty']}}" required>
                           </div>
                           <div class="col-md-4">
                              <label for="attr_image" class="control-label mb-1"> Image</label>
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                             @if($product_attribute['attr_image']!='' && $product_attribute['attr_image']!=null)
                             <a href="{{url('storage/media/attr_image/'.$product_attribute['attr_image'])}}"><img src="{{asset('storage/media/attr_image/'.$product_attribute['attr_image'])}}" width="100px"></a>
                              @endif
                           </div>

                           <div class="col-md-2">
                              <label for="attr_image" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              @if($key+1 >= 2)
                              <a  href="{{url('admin/product/product_attr_delete/')}}/{{$product_data['id']}}/{{$product_attribute['id']}}"><button type="button" class="btn mt-4 btn-danger btn-lg">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                                @else
                                <button type="button" class="btn btn-success btn-lg mt-4" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                                @endif
                           
                         

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
                <!--loop End-->
            </div>
         </div>
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
         {{$page_title}}
            </button>
         </div>
         <input type="hidden" name="id" value="{{$product_data['id']}}"/>
      </form>
   </div>
</div>
<script>
   var loop_count=1; 
   function add_more(){
       loop_count++;
       var html='<input id="paid" type="hidden" name="paid[]" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

       html+='<div class="col-md-2"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>'; 

       html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>'; 

       html+='<div class="col-md-2"><label for="price" class="control-label mb-1"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" ></div>';

       var size_id_html=jQuery('#size_id').html(); 
       size_id_html = size_id_html.replace("selected", "");
       html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1"> Size</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';

       var color_id_html=jQuery('#color_id').html(); 
       color_id_html = color_id_html.replace("selected", "");
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';

       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false"></div>';

       html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1"> Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';

       html+='<div class="col-md-2"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn mt-4 btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 

       html+='</div></div></div></div>';

       jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
   }

   var loop_image_count=1; 
   function add_image_more(){
      loop_image_count++;
      var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1"> Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      //product_images_box
       html+='<div class="col-md-2 product_images_'+loop_image_count+'""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 
       jQuery('#product_images_box').append(html)
   }

   function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
   }
   CKEDITOR.replace('short_desc');
   CKEDITOR.replace('desc');
   CKEDITOR.replace('technical_specification');
</script>
@endsection