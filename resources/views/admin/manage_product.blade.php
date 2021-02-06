@extends('admin/layout')
@section('page_title',"$page_title")
@section('product_select','active')
@section('container')

<h1 class="mb10">{{$page_title}}</h1>

<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     @csrf
                     <div class="form-group">
                        <label for="name" class="control-label mb-1"> Name</label>
                        <input id="name" value="{{$product_data[0]['product_name']}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                     </div>
                     <div class="form-group">
                      <div class ="row">
                          <div class="col-md-4">
                          <label for="name" class="control-label mb-1"> Category</label>
                           <select class="form-control" name="category">
                           <option>Select Category</option>
                           @foreach($categories as $keys => $category)

                               @if($product_data[0]['category_id']==$category['id'])
                          <option value="{{$category['id']}}" selected> {{$category['category_name']}}</option>
                              @else
                              <option value="{{$category['id']}}"> {{$category['category_name']}}</option>
                             @endif
                           @endforeach
                           </select>
                          </div> 
                          <div class="col-md-4">
                          <label for="name" class="control-label mb-1"> Sub Category</label>
                           <select class="form-control" name="subcategory">
                           <option>Select Sub Category</option>
                           @foreach($subcategories as $keys => $subcategory)
                           @if($product_data[0]['sub_category_id']==$subcategory['id'])
                          <option value="{{$subcategory['id']}}"selected> {{$subcategory['sub_category_name']}}</option>
                          @else
                          <option value="{{$subcategory['id']}}"> {{$subcategory['sub_category_name']}}</option>
                          @endif
                           @endforeach
                           </select>
                          </div> 
                          <div class="col-md-4">
                          <label for="name" class="control-label mb-1">Brand</label>
                           <select class="form-control" name="brand">
                           <option>Select Brand</option>
                           @php
                           $total=count($brands);
                           @endphp
                           @if($total >0)
                           @foreach($brands as $keys => $brand)
                           @if($product_data[0]['brands_id']==$brand['id'])
                  

                          <option value="{{$brand['id']}}"selected> {{$brand['brands']}}</option>
                            @else
                            <option value="{{$brand['id']}}"> {{$brand['brands']}}</option>
                             @endif
                          @endforeach
                          @elseif($total == 0)
                          <option> No Brand Available</option>
                          @endif
                      
                           </select>
                          </div> 
                      </div>
               
                     </div>
                     <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                     </div>
                  
                     <div class="form-group">
                 
                     </div>
                  
                 
                     
              
                  
                  </div>
               </div>
            </div>
            <h2 class="mb10">Product Attributes</h2>
            <div class="col-lg-12" id="product_attr_box">
             
            @php 
               echo "<pre>";
               print_r($product_attr);
               echo "</pre>";
               @endphp
               @foreach($product_attr as $key => $product_att)
                  
                   @php
                   $new_key=$key+1;
                   @endphp
                   {{$new_key}}
               <input id="paid" type="text" name="paid[]" value="{{$product_att['attr_id']}}">
               <div class="card" id="product_attr_">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                      
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_att['price']}}">
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> MRP</label>
                              <input id="price" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_att['mrp']}}">
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> SKU</label>
                              <input id="price" name="sku[]" type="text" 
                              class="form-control" aria-required="true" 
                              aria-invalid="false" 
                              value="{{$product_att['sku']}}">
                           </div>
                           <div class="col-md-3">
                              <label for="size_id" class="control-label mb-1"> Size</label>
                              <select id="size_id" name="size_id[]" class="form-control">
                                 <option value="">Select</option>
                             
                                 @foreach ($sizes as $size)
                                    <option value="{{$size['id']}}" selected>{{$size['size_name']}}</option>
                      
                            
                                @endforeach
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="color_id" class="control-label mb-1"> Color</label>
                              <select id="color_id" name="color_id[]" class="form-control">
                                 <option value="">Select</option>
                                   @foreach ($colors as $color)
                                    <option value="{{$color['id']}}" selected>{{$color['color_name']}}</option>
                                
                                
                                    @endforeach
                              </select>
                           </div>
                          
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1"> Qty</label>
                              <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_att['qty']}}" >
                           </div>
                     
                           <div class="col-md-2">
                              <label for="attr_image" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                        @if($new_key>=2)
                       @php
                     
                       @endphp
                       <a href="{{url('admin/products/manage_products/delete_attrs')}}/{{$product_att['attr_id']}}/{{$product_att['product_id']}}"> <button type="button" class="btn btn-danger mt-4 btn-lg" >
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                         @else       
                              <a>  <button type="button" class="btn btn-success mt-4 btn-lg" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button></a>
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
         <input type="text" name="id" value="{{$product_data[0]['product_id']}}"/>
      </form>
   </div>
</div>
<script>
   var loop_count=1; 
   function add_more(){
       loop_count++;
       var html=' <input id="paid" hidden type="text" name="paid[]" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

      

      
      if(loop_count >= 2){
        required='';
      }else{
        required='required';
      }
       html+='<div class="col-md-2">'+loop_count+'<label for="price" class="control-label mb-1"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';
       html+='<div class="col-md-2">'+loop_count+'<label for="price" class="control-label mb-1"> MRP</label><input id="price" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';
       html+='<div class="col-md-2">'+loop_count+'<label for="price" class="control-label mb-1"> SKU</label><input id="price" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';
       var size_id_html=jQuery('#size_id').html(); 
       html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1"> Size</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';

       var color_id_html=jQuery('#color_id').html(); 
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';

       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';

     

       html+='<div class="col-md-2"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn mt-4 btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 

       html+='</div></div></div></div>';

       jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
   }
</script>
@endsection