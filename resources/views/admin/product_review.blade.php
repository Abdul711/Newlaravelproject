﻿@extends('admin/layout')
@section('page_title','Product Review')
@section('tax_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                           
    <h1 class="mb10">Product Review</h1>
 
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                       <th>Product Review </th>
                            <th>User Detail / Product</th>
                <th> Data</th>
                <th> Action </th>
                   
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $total_tax=count($data);
                    @endphp
                    @if($total_tax>0)
                        @foreach($data as $list)
                        <tr>
            
                            <td>{{$list->review}}</td>
                     
                            <td>{{$list->user_email}}
                          <p>  {{$list->user_name}}</p>
                           <p> {{$list->user_type}}</p>
                         <p>  {{$list->name}}</p>
                            </td>

<td>{{date("d-F-Y",strtotime($list->added_on))}}</td>
                            <td>
                               
                                @if($list->status==1)
                                    <a href="{{url('admin/product_review/'.$list->id)}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($list->status==0)
                                    <a href="{{url('admin/product_review/'.$list->id)}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                                @endif

                           
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">No Record Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection