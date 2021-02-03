@extends('admin/layout')
@section('page_title','Display Sub Category')
@section('container')
    <h1 class="mb10">Product</h1>
    <a href="{{url('admin/products/manage_products')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Product
        </button>
    </a>
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
                            <th>View Detail</th>
                            <th> Product Name</th>
                     
                            <th> Added On </th>
                            <th colspan="3" class="text-center" > Action </th>
                        </tr>
                    </thead>
                    <tbody>
                
            
                 
           
      
           
             
@php
$i=2;
@endphp     

@foreach($subcategories as $key => $sub)

<tr>
<td>{{$key+1}}</td>
<td><a class="btn btn-warning" href="{{url('admin/products/view_detail')}}/{{$sub['id']}}">Detail</a></td> 
<td>{{$sub['product_name']}}      </td>


<td>{{ date("d-M-Y H:i:s",strtotime($sub['created_at']))}}</td>

@if($sub['status']==0)
<td><a class="btn btn-warning" href="{{url('admin/products/status')}}/{{$sub['id']}}/{{$sub['status']}}">Deactive</a></td> 
@elseif($sub['status']==1)
<td><a class="btn btn-success" href="{{url('admin/products/status')}}/{{$sub['id']}}/{{$sub['status']}}">Active</a></td> 
@endif
<td><a class="btn btn-outline-secondary" href="{{url('admin/products/manage_products')}}/{{$sub['id']}}">Edit</a></td> 
<td><a class="btn btn-outline-danger" href="{{url('admin/sub_category/delete')}}/{{$sub['id']}}">Delete</a></td>
</tr>
@endforeach


                 </tr>
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection