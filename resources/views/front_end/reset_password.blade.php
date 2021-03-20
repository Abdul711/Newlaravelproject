

@extends('front_end/layout')
@section('container')

  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-12">
                <div class="aa-myaccount-register">                 
                 <h4>ForGet Password</h4>
                 <form action="{{url('reset')}}" method="POST" id="password_reset" class="aa-login-form">
              
                    <label for="">New Password<span>*</span></label>
                    <input type="password" id="new_pass" value="" name="new_pass" placeholder="Enter New Password">
                    <label for="">Confirm New Password<span>*</span></label>
                    <input type="password" id="c_new_pass" value="" name="c_new_pass" placeholder="Enter New Confirm Password">
                    <label for="">Enter OTP<span>*</span></label>
                    <input type="text" id="otp" value="" name="otp" placeholder="Enter OTP">
                    @csrf
                    <input type="hidden" id="" value="{{$token}}" name="c_token">
                    <button type="submit" id="register" class="aa-browse-btn">Reset Password</button>   

                   
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>


 @endsection
 <!-- / Cart view section -->

 


    
  <!-- jQuery library -->



