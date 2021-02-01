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
                              
                         
                                        <form enctype="multipart/form-data" action="{{route('product.store')}}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1"> Product Name</label>
                                                <input id="cc-pament" name="product_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_name')}}{{$product_name}}">
                                                <input id="cc-pament" name="product_id" hidden type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_name')}}{{$product_id}}">

                                            </div>
                                           <div> 
                                           <div class="form-group">
                                                
                                           <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                              
                                                <select name="category_id">
                                                @foreach($c as $c_data)
                                                <option value="{{$c_data['id']}}">{{$c_data['category_name']}}</option>
                                                @endforeach
                                                </select>


                                           </div>
                             
                                           <div class="form-group">
                                                
                                                <label for="cc-payment" class="control-label mb-1">Sub Category Name</label>
                                                   
                                                     <select name="sub_category_id">
                                                     @foreach($sub as $sub_data)
                                                     <option value="{{$sub_data['id']}}">{{$sub_data['sub_category_name']}}</option>
                                                     @endforeach
                                                     </select>
     

                                                </div>
                                            <div>
                                            <div class="form-group">
                                                
                                                <label for="cc-payment" class="control-label mb-1">Select Size</label>
                                                   
                                                     <select name="size_id">
                                                     @foreach($sizes as $size)
                                                     <option value="{{$size['id']}}">{{$size['size_name']}}</option>
                                                     @endforeach
                                                     </select>
     

                                                </div>
                                            <div>
                                            <div class="form-group">
                                                
                                                <label for="cc-payment" class="control-label mb-1">Select Color</label>
                                                   
                                                     <select name="color_id">
                                                     @foreach($colors as $color)
                                                     <option value="{{$color['id']}}">{{$color['color_name']}}</option>
                                                     @endforeach
                                                     </select>
     

                                                </div>
                                            <div>
                                            <input type="file" name="image" >
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                                    <span id="payment-button-amount">{{$product_btn}}</span>
                                                
                                                </button>
                                                
                                          
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            
                            
                        </div>
                        
        </div>
    </div>
                        
@endsection

