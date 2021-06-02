@extends('admin/layout')
@section('page_title','Product')
@section('container')



@php

@endphp




<a href="{{url('admin/product')}}" class="btn btn-outline-primary"> Back </a>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <table class="table table-borderless table-striped ">
                         
                                        <tbody>
                                        <td colspan="3" class="text-center"> {{$product_name}}</td>
                                            <tr>
                                                 <td> Category </td>
                                                <td colspan='2'>{{$category}} </td>
                                                </tr>
                                                <tr>
                                                 <td> Product Id </td>
                                                <td colspan='2'>{{$product_id}} </td>
                                                </tr>
                                                <td>Brand</td>
                                                <td colspan='2'>{{$brand}}</td>
                                                </tr>
                                                </tr>
                                                <td>Sub Category</td>
                                                <td colspan='2'>{{$sub_category}}</td>
                                                </tr>
                                                <tr>
                                                <td >Current Status</td>
                                                <td colspan='2'>{{$status}}</td>
                                                </tr>
                                          
                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
</div>
<div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Color</th>
                            <th>Size</th>
                        
                            <th>Qty Sell</th>
                            <th>Qty Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product_attributes as $key=> $list)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                            @if($list->color_name!="")
                            
                            {{$list->color_name}}
                            @else No Color 
                            @endif
                            
                            </td>
                            <td>@if($list->size_name!=""){{$list->size_name}}@else No Size @endif</td>
                       
                            <td>
                            {{SellDetail($list->attr_id)}}
                              
                            </td>
                            <td> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        

@endsection