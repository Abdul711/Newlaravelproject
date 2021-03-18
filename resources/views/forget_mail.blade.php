@extends('/front_end/layout2')

Hi {{$name}}
Link For Reset Password Given Below
<a href="{{urL('reset_password/'.$token)}}" class"btn btn-success" >Reset Password</a>

Your Password Reset OTP Is {{$otp}}