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
    <a href="{{url('admin/product/manage_product')}}">
        <button type="button" class="btn btn-success">
            Add Products
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
                            
                            <th>Image</th>
                            <th colspan="3" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                 
                    
                                       
                        @foreach($data as $key => $product_data)
                        <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$product_data->product_name}}</td>
                       <td> <a href="{{url('storage/media/'.$product_data->image)}}"> <img src="{{asset('storage/media/'.$product_data->image)}}" width="100px"> </a>  </td>
                       @if($product_data['status']==0)
<td><a class="btn btn-warning" href="{{url('admin/product/status')}}/{{$product_data['id']}}/{{$product_data['status']}}">Deactive</a></td> 
@elseif($product_data['status']==1)
<td><a class="btn btn-success" href="{{url('admin/product/status')}}/{{$product_data['id']}}/{{$product_data['status']}}">Active</a></td> 
@endif
<td><a class="btn btn-outline-secondary" href="{{url('admin/product/manage_product')}}/{{$product_data['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/product/delete')}}/{{$product_data['id']}}">Delete</a></td>
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
          
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection