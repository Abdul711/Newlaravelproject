@extends('admin/layout')
@section('page_title',"$page_title")
@section('container')
<h1 class="mb10">{{$page_title}}</h1>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            @if(session()->has('message'))

<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <span class="badge badge-pill badge-success">Congratulations</span>

    {{session('message')}}	
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif 
      
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Product Name</th>
                        <th>Qty</th>
                            <th> Prrice </th>
                            <th colspan="3" class="text-center" > Total </th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($cart_details as $key => $cart_detail)
   
              <tr>
              <td>
              {{$key+1}}
              </td>
      <td>
      {{$cart_detail->name}}
      <p>Color:{{$cart_detail->color_name}}</p>
      <p>Size:{{$cart_detail->size_name}}</p>
      <img src="{{asset('storage/media/'.$cart_detail->image)}}" width="150" height="150">
      
      </td>
      <td>{{$cart_detail->qty}}</td>
      <td>{{$cart_detail->price}}Rs</td>
      <td>{{$cart_detail->price * $cart_detail->qty}}Rs</td>
      </tr>
           
             
  
        @endforeach

            
         






                            
             
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</div>


 






















                        
@endsection