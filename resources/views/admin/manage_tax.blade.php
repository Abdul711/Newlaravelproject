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
                                                <label for="size" class="control-label mb-1">Tax Value </label>
                                                <input id="tax_value" value="{{$tax_value}}" name="tax_value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                @error('tax_value')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Tax Desc </label>
                                                <input id="tax_desc" value="{{$tax_desc}}" name="tax_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            </div>
                                            
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                               {{$page_btn}}
            
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$id}}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            
                            
                        </div>
                        
        </div>
    </div>
                        
@endsection