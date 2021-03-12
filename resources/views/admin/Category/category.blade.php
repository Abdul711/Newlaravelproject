@extends('admin/layout')
@section('page_title','Display Category')
@section('container')
    <h1 class="mb10">Category</h1>
    <a href="{{url('admin/category/manage_category')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Category
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
                            <th>Image</th>
                            <th> Added On </th>
                            <th colspan="3" class="text-center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php 
                 $total_record=   count($categories);
                    @endphp 
                    @if($total_record>0)
                    @foreach($categories as $keys => $category)
                     
                        <tr>
                        <td>{{$keys+1}}</td>
                        @if($category['parent_category_id']==0)
                        <td>  {{$category['category_name']}}</td>
                        @else
                        <td>  {{$category['category_name']}} (Sub Category)</td>
                        @endif
                        
                        <td>
                        @if($category['parent_category_id']==0)
                        <img src="{{asset('storage/media/category/'.$category['category_image'])}}">
                       <br> No Parent Category Exists
                   @else
                   Parent Category : {{$parent_category[$category['id']]}}
                    
@endif               
                        
                        </td>
                            <td>{{ date("d-M-Y H:i:s",strtotime($category['created_at']))}}</td>
                              @if($category['status']==0)
                             <td><a class="btn btn-warning" href="{{url('admin/category/status')}}/{{$category['id']}}/{{$category['status']}}">Deactive</a></td> 
                             @elseif($category['status']==1)
                             <td><a class="btn btn-success" href="{{url('admin/category/status')}}/{{$category['id']}}/{{$category['status']}}">Active</a></td> 
                             @endif                         
                            <td><a class="btn btn-outline-secondary" href="{{url('admin/category/manage_category')}}/{{$category['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/category/delete')}}/{{$category['id']}}">Delete</a></td>
                        </tr>
           
                        @endforeach
                        @elseif($total_record<=0)
                        <tr>
                        <td colspan='5' class="text-center text-danger">No Category Found In store</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection