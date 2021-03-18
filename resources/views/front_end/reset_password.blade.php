

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
                 <form action="" method="" id="" class="aa-login-form">
              
                    <label for="">New Password<span>*</span></label>
                    <input type="password" id="" value="" name="new" placeholder="Enter New Password">
                    <label for="">Confirm New Password<span>*</span></label>
                    <input type="password" id="" value="" name="c_new" placeholder="Enter New Confirm Password">
                    <label for="">Enter OTP<span>*</span></label>
                    <input type="text" id="" value="" name="otp" placeholder="Enter OTP">
                    <label for="">Enter Old Password<span>*</span></label>
                    <input type="password" id="" value="" name="old" placeholder="Enter Old Password">
                    <input type="hidden" id="" value="{{$token}}" name="c_token">
                    <button type="submit" id="register" class="aa-browse-btn">Reset Password</button>   

                    @csrf                 
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



