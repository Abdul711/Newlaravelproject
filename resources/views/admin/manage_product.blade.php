
                            
                            
                 
                       

                    


@extends('admin/layout')
@section('page_title',"$product_title")
@section('container')
    <h1 class="mb10 text-primary"> {{$product_title}} </h1>
    <a href="category">
    
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
     
                            <div class="col-lg-12">
                            <p class="text-danger">
                            @error('sub_category_name'){{$message}}@enderror</p>
                                <div class="card">
                                
                                    <div class="card-body">
                                        <div class="card-title">
                                   
                                        </div>
                              
                         
                                        <form 
                                        enctype="multipart/form-data"
                                        action="{{route('product.store')}}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1"> Sub Category Name</label>
                                                <input id="cc-pament" name="product_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_name')}}{{$product_name}}">
                                                <input id="cc-pament" name="product_id" hidden type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_name')}}{{$product_id}}">

                                            </div>
                                        
                                           <div class="form-group">
                                                
                                           <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                              
                                                <select name="category_id">
                                                @foreach($categories as $c_data)
                                                <option value="{{$c_data['id']}}">{{$c_data['category_name']}}</option>
                                                @endforeach
                                                </select>


                                           </div>
                                    <div>
                                           
                                                
                                          
                                            </div>
                              
                                    </div>
                                </div>
                                </div>
                           
                           
                    
                            
                            
                            
                           </div>
                           
        
                       <!-- Product Attribute -->
                           <h1 class="text-center">Product Attribute </h1>
                               <div class="add_r"  >
                                <div class="card">
                                
                                <div class="card-body">
                                
                            <div class="form-group">

                            <div class="row">
                              <div class="col-md-3"> 
                              
                              <label> Price </label>
                              <input type="text" id="price" name="price[]" placeholder="Price" class="form-control">
                              </div> 

                            </div>
                            
                        
                            
                            
                            </div>
                          
                            </div>
                            
                            </div>
                            </div>
                            </div>
                            <button class="add_more btn btn-primary"> Add More</button>
                            <div class="add_more_attribute"> 
                            
                          
                            
                            
                            </div>
                        
                            
                  <h1 class="text-center">  Product Image</h1>
                            <div class="card">
                                
                                <div class="card-body">
                                
                            <div class="form-group">

                            <div class="row">
                              <div class="col-md-3"> 
                              <input type="file" name="image[]">
                               </div>
                            </div>
                    </div>
                     </div>
                 </div>


                 <div class="card">
                                
                                <div class="card-body">
                                
                            <div class="form-group">

                            <div class="row">
                              <div class="col-md-3"> 
                              <input type="file" name="image[]">
                               </div>
                            </div>
                    </div>
                     </div>
                 </div>
                 <div class="card">
                                
                                <div class="card-body">
                                
                            <div class="form-group">

                            <div class="row">
                              <div class="col-md-3"> 
                              <input type="file" name="image[]">
                               </div>
                            </div>
                    </div>
                     </div>
                 </div>

                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                               <span id="payment-button-amount">{{$product_btn}}</span>
                                           
                                           </button>                            
                            
                                           </form>
    </div>
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
<script>

$(document).ready(function(){
    $('.add_more').click(function(e){
       var html_more= '<div class="card">';
       html_more+= '<div class="card-body">';
       html_more+= ' <div class="form-group">';
       html_more+= ' <div class="row">';
       html_more+= ' <div class="col-md-3">'; 
       html_more+= '<label> Price </label>';
       html_more+='<input type="text" name="price[]" class="form-control">';
       html_more+='</div>';
      html_more+='</div></div></div></div>';


alert(html_more);
$('.add_more_attribute').append($(".add_r").html());
     

      e.preventDefault();
    });
});

</script>                        
@endsection

