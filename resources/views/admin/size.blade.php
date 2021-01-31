@extends('admin/layout')
@section('page_title','Display Size')
@section('container')
    <h1 class="mb10">Size</h1>
    <a href="{{url('admin/size/manage_size')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Size
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
                            <th>Name</th>
                            <th> Added On </th>
                            <th colspan="3" class="text-center">  Action </th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $keys => $category)
                        
                        <tr>
                        <td>{{$keys+1}}</td>
                            <td>{{$category['size_name']}}</td>
                            <td>{{ date("d-M-Y H:i:s",strtotime($category['created_at']))}}</td>
                            @if($category['status']==0)
                             <td><a class="btn btn-warning" href="{{url('admin/size/status')}}/{{$category['id']}}/{{$category['status']}}">Deactive</a></td> 
                             @elseif($category['status']==1)
                             <td><a class="btn btn-success" href="{{url('admin/size/status')}}/{{$category['id']}}/{{$category['status']}}">Active</a></td> 
                             @endif             
                            <td><a class="btn btn-outline-secondary" href="{{url('admin/size/manage_size')}}/{{$category['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/size/delete')}}/{{$category['id']}}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection