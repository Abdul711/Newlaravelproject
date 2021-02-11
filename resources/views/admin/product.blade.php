@extends('admin/layout')
@section('page_title','Product')
@section('product_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     
    <h1 class="mb10">Product</h1>
    <a href="{{url('admin/products/manage_products')}}">
        <button type="button" class="btn btn-success">
            Add Productc
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($data as $list)
                    
                      <td>{{$list['product_name']}}</td>
                      <td>{{$list['product_name']}}</td>
                      <td>{{$list['product_name']}}</td>
                      <td>{{$list['product_name']}}</td>
                      <td>{{$list['product_name']}}</td>
                      
                      <td><a class="btn btn-outline-secondary" href="{{url('admin/products/manage_products')}}/{{$list['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/products/delete')}}/{{$list['id']}}">Delete</a></td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection