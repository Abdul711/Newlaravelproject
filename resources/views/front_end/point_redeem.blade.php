@extends('front_end/layout')
  @section('page_title','Redeem Point And Gain Rewards')
@section('container')
  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 @if(session()->has('message'))

<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <span class="badge badge-pill badge-success">Congratulations</span>

    {{session('message')}}	
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif 
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
               <diV>

<table class="table">
<tr>
<th>Point</th>
<th>Rewards</th>
<th>Redeem</th>
</tr>
@foreach($rewards as $reward)
<tr>
<td>{{$reward['point']}} Points</td>
<td>{{$reward['reward']}} Rs</td>
<td>
@php
$needed_points=$reward['point']-$points;
@endphp
@if($points >= $reward["point"])
<a href="{{url('redeem/'.$reward['id'])}}" class="btn btn-success">Redeem</a>
@else
<a href="javascript:void(0)" class="btn btn-danger">Need {{$needed_points}} Point To Redeem</a>
@endif
</td>
</tr>
@endforeach

</table>

                              
               </div>
         </diV>
         <div>
                      </div>
                      </div>
                   </div>
                 </div>   
                 </section>
               @endsection