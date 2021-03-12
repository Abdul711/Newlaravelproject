@extends('admin/layout')
@section('page_title','Display Sub Category')
@section('container')
    <h1 class="mb10">Sub Category</h1>
 
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
                            <th> Sub Categories Name</th>
                        <th>Parent Category </th>
                            <th> Added On </th>
                           
                        </tr>
                    </thead>
                    <tbody>
                
            
                 
              
      
           
             
@php
$i=2;
$total_record=   count($subcategories);
        
@endphp     

               
                    @if($total_record>0)
@foreach($subcategories as $key => $sub)

<tr>
<td>{{$key+1}}</td>
<td>{{$sub['category_name']}}      </td>

<td> {{$parent_category[$sub['id']]}} </td>

<td>{{ date("d-M-Y H:i:s",strtotime($sub['created_at']))}}</td>


@endforeach
@elseif($total_record<=0)
                        <tr>
                        <td colspan='5' class="text-center text-danger">No Sub Category Found In store</td>
                        </tr>
                        @endif

            
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection