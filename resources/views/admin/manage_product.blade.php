

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
@error('tax_id.*')
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
                        <input id="name" value="{{$product_data['product_name']}}" 
                        name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                     </div>
               
                     <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                        @if($product_data['image']!='')
                              <a href="{{url('storage/media/'.$product_data['image'])}}" target="_blank"> <img width="100px" src="{{asset('storage/media/'.$product_data['image'])}}"/></a>
                              @endif
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Category</label>
                              <select id="category_id" name="category_id" class="form-control">
                                 <option value="">Select Categories</option>
                                 @foreach($categories as $category)
                                 @if($product_data['category_id']==$category['id'])
                                 <option selected value="{{$category['id']}}">
                                    @else
                                 <option value="{{$category['id']}}">
                                    @endif
                                    {{$category['category_name']}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="sub_category_id" class="control-label mb-1">Sub Category</label>
                              <select id="category_id" name="sub_category_id" class="form-control">
                                 <option value="">Select Categories</option>
                                 @foreach($subcategories as $subcategory)
                                 @if($product_data['sub_category_id']==$subcategory['id'])
                                 <option selected value="{{$subcategory['id']}}">
                                    @else
                                 <option value="{{$subcategory['id']}}">
                                    @endif
                                    {{$subcategory['sub_category_name']}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="brand_id" class="control-label mb-1">Brand </label>
                              <select id="category_id" name="brand_id" class="form-control" >
                                 <option value="">Select Brand</option>
                                 @foreach($brands as $brand)
                                 @if($product_data['brand_id']==$brand['id'])
                                 <option selected value="{{$brand['id']}}">
                                    @else
                                 <option value="{{$brand['id']}}">
                                    @endif
                                    {{$brand['brands']}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-6">
                              <label for="category_id" class="control-label mb-1">Is Available</label>
                              <select id="category_id" name="available" class="form-control" required>
                            
                                 @if($product_data['availability']=='1')
                                 <option value="1" selected>Yes</option>
                                 <option value="0">No</option>
                                 @else
                                 <option value="1">Yes</option>
                                 <option value="0" selected>No</option>
                                 @endif
                              </select>
                           </div>
                           <div class="col-md-6">
                     
                              <label for="is_feat" class="control-label mb-1">Is Featured</label>
                              <select id="category_id" name="feature" class="form-control">
                          
                       
                                 @if($product_data['featured']==='1')
                                 <option selected value="1" >Yes</option>
                                 <option  value="0">No</option>
                                    @else
                                    <option selected value="0" >No</option>
                                    <option  value="1">Yes</option>
                                    @endif
                                 
                              
                     
                              </select>
                           </div>
                         
                        </div>
                     </div>
                     <!--product_image-->
                  </div>
               </div>
            </div>
            <h2 class="mb10 ml15">Product Images</h2>
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row" id="product_images_box">
                        @php 
                        $loop_count_num=1;
                        @endphp
                        @foreach($product_images as $key=>$pIArr)
                        @php 
                        $loop_count_prev=$loop_count_num;
                     
                        @endphp
                        <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
                        <div class="col-md-2 product_images_{{$loop_count_num++}}"  >
                              <label for="images" class="control-label mb-1"> Image</label>
                              <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >

                           </div>
                       
                           <div class="col-md-2">
                      
                              <label for="images" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                        
                              @if($loop_count_num==2)
                                <button type="button" class="btn btn-success mt-4 btn-lg" onclick="add_image_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$product_data['id']}}"><button type="button" class="btn btn-danger mt-4 btn-lg">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
  
                              
                           @endif 
                           @if($pIArr['images']!='')
                           <a href="{{url('storage/media/product_images/'.$pIArr['images'])}}" target="_blank"><img width="100px" src="{{asset('storage/media/product_images/'.$pIArr['images'])}}"/></a>
                              @endif
                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
            <h2 class="mb10 ml15">Product Attributes</h2>
            <div class="col-lg-12" id="product_attr_box">
               @php 
               $loop_count_num=1;
               @endphp
               @foreach($product_attributes as $key=>$pAArr)
               @php 
               $loop_count_prev=$loop_count_num;
            
               @endphp
               <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
               <div class="card" id="product_attr_{{$loop_count_num++}}">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-2">
                              <label for="sku" class="control-label mb-1"> SKU</label>
                              <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['sku']}}" >
                           </div>
                           <div class="col-md-2">
                              <label for="mrp" class="control-label mb-1"> MRP</label>
                              <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['mrp']}}">
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['price']}}" >
                           </div>
                           <div class="col-md-3">
                              <label for="size_id" class="control-label mb-1"> Size</label>
                              <select id="size_id" name="size_id[]" class="form-control">
                                 <option value="">Select</option>
                                 @foreach($sizes as $size)
                                    @if($pAArr['size_id']==$size['id'])
                                    <option value="{{$size['id']}}" selected>{{$size['size_name']}}</option>
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
                                    @if($pAArr['color_id']==$color['id'])
                                    <option value="{{$color['id']}}" selected>{{$color['color_name']}}</option>
                                    @else
                                    <option value="{{$color['id']}}">{{$color['color_name']}}</option>
                                    @endif
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="color_id" class="control-label mb-1">Tax</label>
                              <select id="tax_id" name="tax_id[]" class="tax tax-{{$key}} form-control">
                                 <option value="">Select</option>
                                 @foreach($taxes as $tax)
                                    @if($pAArr['tax_id']==$tax['id'])
                                    <option value="{{$tax['id']}}" selected>{{$tax['tax_desc']}}</option>
                                    @else
                                    <option value="{{$tax['id']}}">{{$tax['tax_desc']}}</option>
                                    @endif
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1"> Qty</label>
                              <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['qty']}}" required>
                           </div>
                           <div class="col-md-4">
                              <label for="attr_image" class="control-label mb-1"> Image</label>
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >

                              @if($pAArr['attr_image']!='')
                              <a href="{{url('storage/media/attr_image/'.$pAArr['attr_image'])}}" target="_blank"> <img width="100px" src="{{asset('storage/media/attr_image/'.$pAArr['attr_image'])}}"/></a>
                              @endif
                           </div>
                           <div class="col-md-2">
                              <label for="attr_image" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                              @if($loop_count_num==2)
                                <button type="button" class="btn btn-success mt-4 btn-lg" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a href="{{url('admin/product/product_attr_delete/')}}/{{$product_data['id']}}/{{$pAArr['id']}}"><button type="button" class="mt-4 btn btn-danger btn-lg">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                              @endif  

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            {{$page_btn}}
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
       var tax_id_html=jQuery('#tax_id').html(); 
       tax_id_html = tax_id_html.replace("selected", "");
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Tax</label><select id="color_id" name="tax_id[]" class="form-control" >'+tax_id_html+'</select></div>';
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
      var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-2 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1"> Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      //product_images_box
       html+='<div class="col-md-2 product_images_'+loop_image_count+'""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger mt-4 btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 
       jQuery('#product_images_box').append(html);
   }

   function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
   }

   
</script>
@endsection