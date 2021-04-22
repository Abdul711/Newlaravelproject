@extends('admin/layout')
@section('page_title','Reward Management')
@section('container')
    <h1 class="mb10">Reward Management</h1>
    <a href="{{url('admin/reward/manage_rewards')}}">
        <button type="button" class="btn btn-outline-success m-3">
            Add Rewards
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
                            <th>Point</th>
                             <th> Rewards </th>
                             <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                
   
              
      
           
             
  
        

                    @php 
           
                    @endphp 
                  
@foreach($rewards as $keys => $value)
@php
if($value->status==1){
$btn_class="btn btn-success";
$btn_text="Active";
}else{
    $btn_class="btn btn-danger";
$btn_text="Deactive";
}
@endphp
             <tr>
<td>{{$keys+1}}

</td>

<td>
{{$value->point}} Points
</td>
<td>
{{$value->reward}} Rs
</td>
<td>
<a href="{{url('admin/reward/status/'.$value->id)}}" class="{{$btn_class}}">{{$btn_text}}</a>
</td>





                            
                 </tr>
     @endforeach      
        
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection