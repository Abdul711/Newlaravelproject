@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')

<h1 class="mb10">Manage Product</h1>
<a href="{{url('admin/product')}}">
<button type="button" class="btn btn-success">
Back
</button>
</a>
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
                        <input id="name" value="" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
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
             
               <input id="paid" type="hidden" name="paid[]" value="">
               <div class="card" id="product_attr_">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                      
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> SKU</label>
                              <input id="price" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
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
                              <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" >
                           </div>
                           <div class="col-md-4">
                              <label for="attr_image" class="control-label mb-1"> Image</label>
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                           </div>
                           <div class="col-md-2">
                              <label for="attr_image" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                        
                                <button type="button" class="btn btn-success mt-4 btn-lg" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
            
                         
                     

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         
            </div>
         </div>
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
         <input type="hidden" name="id" value=""/>
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
       html+='<div class="col-md-2">'+loop_count+'<label for="price" class="control-label mb-1"> SKU</label><input id="price" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';
       var size_id_html=jQuery('#size_id').html(); 
       html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1"> Size</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';

       var color_id_html=jQuery('#color_id').html(); 
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';

       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';

       html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1"> Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" '+required+'></div>';

       html+='<div class="col-md-2"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn mt-4 btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 

       html+='</div></div></div></div>';

       jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
   }
</script>
@endsection