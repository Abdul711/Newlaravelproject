@extends('admin/layout')
@section('page_title','Display Coupon Code')
@section('container')
    <h1 class="mb10">Coupon Manage </h1>
    <a href="{{url('admin/coupon/manage_coupon')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Coupon
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
                            <th>Coupon Code</th>
                            <th>Coupon Value </th>
                            <th>Cart Min Value </th>
                            <th>Coupon Type </th>
                            <th> Added On </th>
                            <th colspan="3"> Action </th>
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
                            <td>{{$category['coupon_code']}}</td>
                            @if($category['coupon_type']=="Fixed")
                            <td>{{$category['coupon_value']}} Rs</td>
                            @elseif($category['coupon_type']=="Percentage")
                            <td>{{$category['coupon_value']}} %</td>
                            @endif
                            <td>{{$category['cart_min_value']}}RS</td>
                            <td>{{$category['coupon_type']}}</td>
                            <td>{{ date("d-M-Y H:i:s",strtotime($category['created_at']))}}</td>
                            @if($category['status']==0)
                             <td><a class="btn btn-warning" href="{{url('admin/coupon/status')}}/{{$category['id']}}/{{$category['status']}}">Deactive</a></td> 
                             @elseif($category['status']==1)
                             <td><a class="btn btn-success" href="{{url('admin/coupon/status')}}/{{$category['id']}}/{{$category['status']}}">Active</a></td> 
                             @endif        
                            <td><a class="btn btn-outline-secondary" href="{{url('admin/coupon/manage_coupon')}}/{{$category['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/coupon/delete')}}/{{$category['id']}}">Delete</a></td>
                        </tr>
                     
                   
                      
                        @endforeach
                        @elseif($total_record<=0)
                        <tr>
                        <td colspan='7' class="text-center text-danger">No Coupon Code Found In store</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection