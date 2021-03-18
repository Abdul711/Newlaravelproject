

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
                 <form action="" method="" id="send_link" class="aa-login-form">
              
                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" id="user_reset_pass_email" value="" name="user_email" placeholder="Username or email">
                  
                    <button type="submit" id="register" class="aa-browse-btn">Send Password Reset Link</button>   

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



