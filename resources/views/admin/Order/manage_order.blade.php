@extends('admin/layout')
@section('page_title',"$page_title")
@section('container')
<h1 class="mb10">{{$page_title}}</h1>

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
                            <th>Product Name</th>
                        <th>Qty</th>
                            <th> Prrice </th>
                            <th colspan="3" class="text-center" > Total </th>
                        </tr>
                    </thead>
                    <tbody>
                
   
              
      
           
             
  
        

            
         






                            
             
                 </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>



 






















                        
@endsection