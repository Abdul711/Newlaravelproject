@extends('admin/layout')
@section('page_title','Product')
@section('container')



@php

@endphp

<a href="{{url('admin/products')}}" class="btn btn-outline-primary"> Back </a>
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
                                                <td>Sub Category</td>
                                                <td colspan='2'>{{$sub_category}}</td>
                                                </tr>
                                                <tr>
                                                <td>Brand</td>
                                                <td colspan='2'>{{$brand}}</td>
                                                </tr>
                                                <tr>
                                                <td >Current Status</td>
                                                <td colspan='2'>{{$status}}</td>
                                                </tr>
                                          
                                                @foreach($product_attributes  as $keys => $product_attribute)                              
                                                @php
                                             $product_attribute=(array)$product_attribute;
                                             print_r($product_attribute);
                                                @endphp
                                                <tr>
                                                <td> Size {{ $product_attribute['p_att_size_name']}}</td>
                                                <td> Price :{{$product_attribute['attribute_price']}} Rs</td>
                                                <td>  Color {{ $product_attribute['p_att_c_name']}} </td>   
                                                </tr>
                                                <tr>
                                                             
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection