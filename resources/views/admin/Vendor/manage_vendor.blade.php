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
                                        <form action="{{route('vendor.manage_vendor_process')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Vendor Name </label>
                                                <input id="vendor_name" value="{{$vendor_name}}" name="vendor_name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('vendor_name')
                        <div class="sufee-alert alert mt-1 with-close alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Vendor Email </label>
                                              
                                                <input id="tax_desc" value="{{$vendor_email}}" name="vendor_email" type="text" class="form-control" aria-required="true" aria-invalid="false" >
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
                                                <label for="size" class="control-label mb-1">Vendor Mobile </label>
                                                <input id="tax_desc" value="{{$vendor_mobile}}" name="vendor_mobile" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('vendor_mobile')
                        <div class="sufee-alert alert with-close mt-1 alert-danger alert-dismissible fade show">
                                    {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
                                                @enderror
                                            </div>

                                            @if($vendor_id=='')
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Vendor Password </label>
                                                <input id="tax_desc" value="" name="vendor_password" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('vendor_password')
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
                                            <input type="hidden" name="id" value="{{$vendor_id}}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            
                            
                        </div>
                        
        </div>
    </div>
                        
@endsection