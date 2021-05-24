@extends('admin/layout')
@section('page_title',"Contact Us ")
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
    <h1 class="mb10">Contact Us</h1>
 
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                       <th> S.NO </th>
                            <th>User Detail </th>
                            <th> Date  </th>
                            <th>Message</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $total_tax=count($data);
                    @endphp
                    @if($total_tax>0)
                        @foreach($data  as $key=> $list)
                        @php
                        $key=$key+1;
                        @endphp
                        <tr>
                 <td>{{$key}}</td>
                      

                            <td>
                            <p>{{$list->user_name}}</p>
                       {{$list->email}}
                          <p>  {{user_type($list->email)}}</p>               
                        <p>  {{$list->mobile}}</p>
                           
                            </td>
                            <td>
                         
{{date("d-F-Y",strtotime($list->created_at))}}
                           
                            </td>
                          <td> {{$list->message}} </td>
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