@extends('admin/layout')
@section('page_title',"$category_title")
@section('container')
    <h1 class="mb10 text-primary"> {{$category_title}} </h1>
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
                      
                         
                                        <form action="{{route('category.store')}}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                                <input id="cc-pament" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_name')}}{{$category_name}}">
                                                <input id="cc-pament" name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" hidden="hidden" value="{{$category_id}}">
                                            </div>
                                  
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               
                                                    <span id="payment-button-amount">{{$category_btn}}</span>
                                                
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