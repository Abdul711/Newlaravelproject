@extends('admin/layout')
@section('page_title',"$page_title")
@section('tax_select','active')
@section('container')
    <h1 class="mb10">{{$page_title}}</h1>

                    
                 
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{route('rider.manage_rider_process')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Rider Name </label>
                                                <input id="rider_name" value="{{$rider_name}}" name="rider_name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('rider_name')
                        <div class="sufee-alert alert mt-1 with-close alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Rider Email </label>
                                              
                                                <input id="tax_desc" value="{{$rider_email}}" name="rider_email" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('rider_email')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Rider Mobile </label>
                                                <input id="tax_desc" value="{{$rider_mobile}}" name="rider_mobile" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('rider_mobile')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>

                                            @if($rider_id=='')
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Rider Password </label>
                                                <input id="tax_desc" value="" name="rider_password" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('rider_password')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>
                                            @endif
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    {{$page_title}}
                                                </button>
                                            </div>
                                            <input type="text" name="id" value="{{$rider_id}}"/>
                                            <input type="hidden" name="status" value="{{$rider_status}}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            
                            
                        </div>
                        
        </div>
    </div>
                        
@endsection