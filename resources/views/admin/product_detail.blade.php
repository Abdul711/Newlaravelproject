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
                                        <td colspan="2" class="text-center"> {{$product}}</td>
                                            <tr>
                                                 <td> Category Name </td>
                                                <td>{{$category}} </td>
                                                </tr>
                                                <tr>
                                                <td>Sub Category</td>
                                                <td>{{$sub_category}}</td>
                                                </tr>
                                               
                                                <tr>
                                                <td>Current Status</td>
                                                <td>{{$status}}</td>
                                                </tr>
                                             
                                            
                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection