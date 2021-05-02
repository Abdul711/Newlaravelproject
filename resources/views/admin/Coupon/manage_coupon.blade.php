@extends('admin/layout')
@section('page_title',"$coupon_title")
@section('container')
    <h1 class="mb10 text-primary"> {{$coupon_title}} </h1>
    <a href="category">
    
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
     
                            <div class="col-lg-12">
                            <p class="text-danger">
                        
            
                                <div class="card">
                                
                                    <div class="card-body">
                                        <div class="card-title">
                                   
                                        </div>
     
                         
                                        <form action="{{route('coupon.store')}}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Coupon Code </label>
                                                <input id="cc-pament" name="coupon_code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('coupon_code')}}{{$coupon_name}}">
                                                <p class="text-danger"> @error('coupon_code'){{$message}}@enderror</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Coupon Value (Discount) </label>
                                                <input id="cc-pament" name="coupon_code_value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('coupon_code_value')}}{{$coupon_value}}">
                                                <p class="text-danger">@error('coupon_code_value'){{$message}}@enderror</p>                                
                                            </div> 
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Coupon Max Discount </label>
                                                <input id="cc-pament" name="coupon_max_discount" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('coupon_max_discount')}}{{$coupon_max_discount}}">
                                                <p class="text-danger">@error('coupon_max_discount'){{$message}}@enderror</p>                                
                                            </div> 
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Cart Min Value </label>
                                                <input id="cc-pament" name="cart_min_value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('cart_min_value')}}{{$coupon_cart}}">
                                                <p class="text-danger"> @error('cart_min_value'){{$message}}@enderror</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Limit Per User </label>
                                                <input id="cc-pament" name="limit_per_user" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$limit_per_user}}">
                                                <p class="text-danger"> </p>
                                            </div>
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Expiry Date </label>
                                            <input id="cc-pament" name="expiry_date" type="datetime-local" class="form-control" aria-required="true" aria-invalid="false" value="{{$expiry_date}}">
                                            </div>
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Select Coupon Type </label>
                                            <select name="coupon_type">
                                            <option value="">Select Coupon Type</option>








                                               @if($coupon_type=="Fixed")
                                     
                                            <option value="Fixed" selected>Fixed</option>
                                            <option value="Percentage" >Percentage</option>
                                               @elseif($coupon_type=="Percentage")      
                                               <option value="Fixed" >Fixed</option>
                                               <option value="Percentage" selected>Percentage</option>
                                               @else
                                               <option value="Fixed" >Fixed</option>
                                               <option value="Percentage" >Percentage</option>
                                               @endif

                                            </select>
                                            <p class="text-danger"> @error('coupon_type'){{$message}}@enderror</p>
                                            </div>
                                            <input id="cc-pament" name="coupon_id" type="text" class="form-control" aria-required="true" aria-invalid="false" hidden="hidden" value="{{$coupon_id}}">
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                                    <span id="payment-button-amount">{{$coupon_btn}}</span>
                                                
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