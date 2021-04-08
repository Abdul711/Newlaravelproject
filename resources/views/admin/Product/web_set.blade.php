@extends('admin/layout')
@section('page_title',"web_setting")
@section('product_select','active')
@section('container')

<h1 class="mb10"></h1>
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

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{route('settingweb.manage_website_process')}}" method="post" enctype="multipart/form-data">
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
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                     
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Category</label>
                              <select id="category_id" name="category_id" class="form-control">
                           
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Brand</label>
                              <select id="brand" name="brand" class="form-control" >
                                
                              </select>
                           </div>
                           <div class="col-md-4">
                           <label for="category_id" class="control-label mb-1">Sub Category</label>
                             <select name="sub_category" id="subcat" class="form-control">
                          <option>Select Sub Category</option>
                        
                             </select>

                           </div>
                        </div>
                     </div>
              
   
                   
                 

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="model" class="control-label mb-1"> Lead Time</label>
                              <input id="lead_time" value="" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false">
                           </div>
                           <div class="col-md-2">
                              <label for="model" class="control-label mb-1">Delivery Charge</label>
                              <input id="lead_time" value="" name="delivery_charge" type="text" class="form-control" aria-required="true" aria-invalid="false">
                           </div>
                           
                    
                          
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Promo	</label>
                   
                           </div>
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Featured	</label>
                              <select id="is_featured" name="is_featured" class="form-control" required>
            
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Tranding	</label>
                              <select id="is_tranding" name="is_tranding" class="form-control" required>
                
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Discounted	</label>
                              <select id="is_discounted" name="is_discounted" class="form-control" required>
          
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
@endsection
          