@extends('admin/layout')
@section('page_title',"$brand_title")
@section('container')
    <h1 class="mb10 text-primary"> {{$brand_title}} </h1>
    <a href="category">
    
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
     
                            <div class="col-lg-12">
                            <p class="text-danger">
                            @error('category_name'){{$message}}@enderror</p>
                                <div class="card">
                                
                                    <div class="card-body">
                                        <div class="card-title">
                                   
                                        </div>
                      
                         @if(session()->has('error_message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-danger">Some Thing Went Wrong</span>
 {{session('error_message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif                                        
<form action="{{route('brand.store')}}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Brand Name</label>
                                                <input id="cc-pament" name="brand_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('brand_name')}}{{$brand_name}}">
                                                <input id="cc-pament" name="brand_id" type="text" class="form-control" aria-required="true" aria-invalid="false" hidden="hidden" value="{{$brand_id}}">
                                            </div>
                                  
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                                    <span id="payment-button-amount">{{$brand_btn}}</span>
                                                
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