
          @extends('admin/layout')
@section('page_title',"WEB Setting")
@section('container')
    <h1 class="mb10 text-primary">Web setting</h1>
    <a href="category">
    
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
     
                            <div class="col-lg-12">
                            <p class="text-danger">
                            @error('category_name'){{$message}}@enderror</p>
                                <div class="card">
                                
                                    <div class="card-body">
                                        <div class="card-title">
                  
                                        </div>
                      
                         
                                        <form action="{{route('settingweb.manage_website_process')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Min Cart Amout</label>
                                                <input id="cc-pament" 
                                                required name="min_cart_amt" type="text" 
                                                class="form-control"
                                                 aria-required="true" value="{{$min_cart_amt}}">
                                             
                                            </div>
                                      
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Free Delivery Cart Amount</label>
                                                <input id="cc-pament" 
                                                required name="free_delivery_cart"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$free_delivery_cart}}" required="true">
                                             
                                            </div>
               
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Discount On Order</label>
                                                <input id="cc-pament" 
                                                required name="discount_on_first"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$discount_on_first}}" required="true">
                                             
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">No Of Order</label>
                                                <input id="cc-pament" 
                                                required name="no_of_order"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$no_of_order}}" required="true">
                                             
                                            </div>
                                                
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Referal Amount</label>
                                                <input id="cc-pament" 
                                                required name="referral_amount"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$referral_amount}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">First Time Sign Up Reward</label>
                                                <input id="cc-pament" 
                                                required name="sign_up_reward"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$sign_up_reward}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Web Site Email</label>
                                                <input id="cc-pament" 
                                                required name="website_email"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$website_email}}" required="true">
                                             
                                            </div>
                                   
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Web Site Mobile</label>
                                                <input id="cc-pament" 
                                                required name="website_mobile"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$website_mobile}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Return Referal Amount</label>
                                                <input id="cc-pament" 
                                                required name="return_referal_per"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$return_referal_per}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Number Of Order For Referal Amount</label>
                                                <input id="cc-pament" 
                                                required name="number_of_order_for_referal"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$number_of_order_for_referal}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Company Address</label>
                                                <input id="cc-pament" 
                                                required name="company_address"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$company_address}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Income Tax</label>
                                                <input id="cc-pament" 
                                                required name="income_tax"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$income_tax}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Min Delivery Time</label>
                                                <input id="cc-pament" 
                                                required name="min_delivery_time"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$min_delivery_time}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Point Amount</label>
                                                <input id="cc-pament" 
                                                required name="point_amount"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$point_amount}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1"> Reward Percentage</label>
                                                <input id="cc-pament" 
                                                required name="point_reward_per"
                                                 type="text" class="form-control" 
                                                 #aria-required="true" aria-invalid="false" value="{{$point_reward_per}}" required="true">
                                             
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Web Status</label>
                                               <select name="web_status">
                                               @if($web_status=="1")
                                               <option value="1" selected>On</option>
                                               <option value="0">Off</option>
                                               @else
                                               <option value="0" selected>Off</option>
                                               <option value="1">On</option>
                                               @endif
                                               </select>
                                             
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                                    <span id="payment-button-amount">Submit</span>
                                                
                                                </button>
                                                
                                          
                                            </div>
                                                
                                          
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
        </div>
    </div>
                        
@endsection