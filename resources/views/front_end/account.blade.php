

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
                 <h4>Register</h4>
                 <form action="" method="" id="register_user" class="aa-login-form">
                 <label for="">User Name<span>*</span></label>
                    <input type="text" id="user_name_reg"  name="user_name" placeholder="User Name">
                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" id="user_email_reg" value="" name="user_email" placeholder="Username or email">
                    <label for="">Password<span>*</span></label>
                    <input type="text" id="user_email_reg" value="" name="user_email" placeholder="Username or email">
                    <label for="">Mobile<span>*</span></label>
                    <input type="text" id="user_mobile_reg"   name="user_mobile" placeholder="Mobile">
                    <label for="">Referal Code<span>(Optional)</span></label>
                    <input type="text"    name="user_referral_code" placeholder="Referal Code">
                    <div class="wait"></div>
                    <button type="submit" id="register" class="aa-browse-btn">Register</button>   

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



