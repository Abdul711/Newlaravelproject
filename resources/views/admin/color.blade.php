@extends('admin/layout')
@section('page_title','Display Color')
@section('container')
    <h1 class="mb10"> Color</h1>
    <a href="{{url('admin/color/manage_color')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Color
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
                            <th> Color Name</th>
                        
                            <th> Added On </th>
                            <th colspan="3" class="text-center" > Action </th>
                        </tr>
                    </thead>
                    <tbody>
                
   
              
      
           
             
@php
$i=2;
@endphp     
        


@foreach($categories as $keys => $value)

             <tr>
<td>{{$keys+1}}</td>
<td>{{$value['color_name']}}</td>
<td>{{ date("d-M-Y H:i:s",strtotime($value['created_at']))}}</td>
@if($value['status']==0)
<td><a class="btn btn-warning" href="{{url('admin/color/status')}}/{{$value['id']}}/{{$value['status']}}">Deactive</a></td> 
@elseif($value['status']==1)
<td><a class="btn btn-success" href="{{url('admin/color/status')}}/{{$value['id']}}/{{$value['status']}}">Active</a></td> 
@endif
<td><a class="btn btn-outline-secondary" href="{{url('admin/color/manage_color')}}/{{$value['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/color/delete')}}/{{$value['id']}}">Delete</a></td>
                 </tr>
                 @endforeach
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection