

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
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                @php
                if(isset($_COOKIE['login_password']) && isset($_COOKIE['login_email'])){
                  $login_password=$_COOKIE['login_password'];
                  $login_email=$_COOKIE['login_email'];
                  $rememberme="checked='checked'";
                }else{
                  $login_password="";
                  $login_email="";
                  $rememberme="";
                }

                @endphp
                 <form action="" class="aa-login-form login-user">
                  <label for="">Username or Email address<span>*</span></label>
                   <input type="text" value="{{$login_email}}"  name="user_login_email" placeholder="Username or email">
                   <label for="">Password<span>*</span></label>
                    <input name="user_login_password" value="{{$login_password}}" type="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">Login</button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" value="rem" name="rem" id="rememberme" {{$rememberme}}> Remember me </label>
                    <p class="aa-lost-password"><a href="{{url('/forget_password')}}">Lost your password?</a></p>
                    @csrf
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="" method="" id="register_user" class="aa-login-form">
                 <label for="">User Name<span>*</span></label>
                    <input type="text" id="user_name_reg"  name="user_name" placeholder="User Name">
                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" id="user_email_reg" value="" name="user_email" placeholder="Username or email">
                    <label for="">Password<span>*</span></label>
                    <input type="text" id="user_password_reg"   name="user_password" placeholder="Password">
                    <label for="">Mobile<span>*</span></label>
                    <input type="text" id="user_mobile_reg"   name="user_mobile" placeholder="Mobile">
                    <label for="">Referal Code<span>(Optional)</span></label>
                    <input type="text"    name="user_referral_code" placeholder="Referal Code">
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



