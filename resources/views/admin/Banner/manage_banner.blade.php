@extends('admin/layout')
@section('page_title',"")
@section('container')
    <h1 class="mb10 text-primary">{{$page_title}} </h1>
 
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
     
                            <div class="col-lg-12">
                            <p class="text-danger">
                      </p>
                                <div class="card">
                                
                                    <div class="card-body">
                                        <div class="card-title">
                                   
                                        </div>
                                        @error('image')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@enderror
                         
                                        <form action="{{route('banner.store')}}"  enctype="multipart/form-data" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Banner Text</label>
                                                <input id="cc-pament" name="banner_text" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$banner_text}}">
                                                <input id="cc-pament" name="banner_id" type="text" class="form-control" aria-required="true" aria-invalid="false"  value='{{$banner_id}}'>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Banner Link</label>
                                                <input id="cc-pament" name="banner_link" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$banner_link}}">
                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Banner Slug</label>
                                                <input id="cc-pament" name="banner_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$banner_slug}}">
                                               
                                            </div>
                                            <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                    
                            @if($banner_image!='')             
             <a href="{{url('storage/media/banner/'.$banner_image)}}" target="_blank"> 
             <img width="100px" src="{{asset('storage/media/banner/'.$banner_image)}}"/></a>
                            @endif
                     </div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                                    <span id="payment-button-amount">{{$page_btn}}</span>
                                                
                                                </button>
                                                
                                          
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
        </div>
    </div>
                        @endsection