@extends('admin/layout')
@section('page_title',"$page_title")
@section('tax_select','active')
@section('container')
    <h1 class="mb10">{{$page_title}}</h1>

  
@if(session()->has('success_message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <span class="badge badge-pill badge-success">Congratulation</span>
{{session('success_message')}}
	
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
@if(session()->has('error_message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-alert">Some Thing Went Wrong</span>
{{session('error_message')}}
	
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif                
                 
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{route('admin.manage_admin_process')}}" method="post">
                                            @csrf
                                      

                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Admin Email </label>
                                              
                                                <input id="tax_desc" value="{{$admin_email}}" name="vendor_email" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('vendor_email')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Admin Mobile </label>
                                                <input id="tax_desc" value="{{$admin_mobile}}" name="vendor_mobile" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('vendor_mobile')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Admin Old Password </label>
                                                <input id="tax_desc" value="" name="admin_old_password" type="text" class="form-control" aria-required="true" aria-invalid="false" >
    @error('admin_old_password')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                            
                                            @enderror
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Vendor Password </label>
                                                <input id="tax_desc" value="" name="vendor_password" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                  
                                            </div>
                                            
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    {{$page_title}}
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value=""/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            
                            
                        </div>
                        
        </div>
    </div>
                        
@endsection