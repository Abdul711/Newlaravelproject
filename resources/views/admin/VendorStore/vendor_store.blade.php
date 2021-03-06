@extends('admin/layout')
@section('page_title','Display Vendor')
@section('container')
    <h1 class="mb10">Vendor Management</h1>
    <a href="{{url('admin/vendor/manage_vendor')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Vendor
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
      
            <div class=" m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>


                    
                            <th>S.NO</th>
                            <th>Name</th>
                            <th> Email </th>
                            <th> Mobile  </th>
                            <th colspan="3" class="text-center"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php 
                 $total_record=   count($vendors);




                    @endphp 
                    @if($total_record>0)
                    @foreach($vendors as $keys => $brand)
                
                        <tr>
                        <td>{{$keys+1}}</td>
                            <td>{{$brand['user_name']}}</td>
                            <td>{{$brand['email']}}</td>
                            <td>{{$brand['mobile']}}</td>
                              @if($brand['status']==0)
                             <td><a class="btn btn-warning" href="{{url('admin/vendor/status')}}/{{$brand['id']}}/1">Deactive</a></td> 
                             @elseif($brand['status']==1)
                             <td><a class="btn btn-success" href="{{url('admin/vendor/status')}}/{{$brand['id']}}/0">Active</a></td> 
                             @endif                         
                            <td><a class="btn btn-outline-secondary" href="{{url('admin/vendor/manage_vendor')}}/{{$brand['id']}}">Edit</a></td> 
                            <td><a class="btn btn-outline-danger" href="{{url('admin/vendor/delete')}}/{{$brand['id']}}">Delete</a></td>
                        </tr>
                  
                        @endforeach
                        @elseif($total_record<=0)
                        <tr>
                        <td colspan='5' class="text-center text-danger">No Brand Found In store</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection