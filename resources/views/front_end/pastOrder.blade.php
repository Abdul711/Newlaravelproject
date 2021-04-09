
  <!-- / menu -->  
  @extends('front_end/layout')
  @section('page_title','Past Order')
@section('container')
  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->


  <!-- / menu -->  

  <!-- catg header banner section -->
  
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                 <th>S.No</th>
                        <th>Order Id</th>
                        <th>Final Price</th>
                        <th>Payment Method</th>
                        <th>Discount</th>
                        <th>Date/Time</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                             
      <tbody>
                 
                    
                    @foreach($orders as $key => $order)

       

                    
                       
                      <tr>
                      <td>{{$key+1}}</td>
                      <td class="{{$class_ta}}">
                      
                      
                      
                      
                      ORD-{{$order->id}}
                      
                      <a href="{{url('/print_invoice/'.$order->id)}}" class="btn btn-primary m-5">Print Invoice </a>
                      <a href="{{url('/view_detail/'.$order->id)}}" class="btn btn-warning m-5">View Detail
                 </a>
                      
                      </td>
                      <td class="{{$class_ta}}">{{$order->final_price}} Rs </td>
                      <td class="{{$class_ta}}">{{$order->customer_payment}}</td>
                    @if($order->coupon_value>0)
                      <td class="{{$class_ta}}">
                   <p> Discount {{$order->coupon_value}} Rs </p>
                   <p> Coupon: {{$order->coupon_code}} </p>  
                      </td>
                      @else
                           <td class="{{$class_ta}}">No Discount Applied</td>           
                      @endif
                      <td class="{{$class_ta}}">{{date('d-M-Y',strtotime($order->created_at))}}
                      <p>{{date('h:i a',strtotime($order->created_at))}}</p>
                      </td>
                     @if($order->orders_status==1)
                      <td class="{{$class_ta}}">
                      Pending
                      </td>
                      @else
                      <td class="{{$class_ta}}">
                   Other Status
                      </td>
                      @endif
     
     </tr>        

               @endforeach
        
         
                      </tbody>
                  </table>
        
                </div>
             </form>

    <div>
    </div>


    
   
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  

  <!-- / Subscribe section -->
@endsection
  <!-- footer -->  

  <!-- footer -->  
