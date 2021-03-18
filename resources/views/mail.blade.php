@extends('/front_end/layout2')

Hi {{$name}}
Thanks For Registration
<a href="{{urL('customer_verify/'.$token)}}" class"btn btn-success" >Verify Email</a>

