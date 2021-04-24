@extends('admin/layout')
@section('page_title',"$page_title")
@section('container')
<div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Coupon Detail ({{$coupon_code}})</h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <tbody>
                                            
                                            
                                          
                                        
                                                <tr>
                                                    <td>Coupon Type</td>
                                            <td>{{$coupon_type}}</Td>
                                                </tr>
                                                <tr>
                                                    <td>Coupon Value (Discount)</td>
                                            
                                             <td>{{$coupon_value}} </td>
                                                       
                                      
                                                </tr>
                                                  
                                                <tr>
                                                    <td>Cart Min Value</td>
                                                          <td>{{$cart_min_value}}</td>                                         
                                                </tr>
                                                <tr>
                                                    <td>Max Discount</td>
                                            <td>{{$max_discount}} </td>
                                                </tr>
                                                <tr>
                                                    <td>Expired</td>
     
                                                    <td>{{$expired}}</td>
                                              
                                            Coupon Register Date:{{$register_date}}
                                                </tr>
                                              
                                                @if($expired=="No")
                                                @php
                                                $time1=strtotime($expiry_date);
  $time2=strtotime(date("Y-M-d h:i:s"));
  $diff=$time1-$time2;
 
  $minutes=floor($diff/(60*60));

  $days=floor($minutes/24);
                                                @endphp
                                               @if($days>1)
                                               <tr>
                                                    <td>Expiry Date</td>
                                                    <td>{{date("d-F-Y H:i a",strtotime($expiry_date))}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Time Remaining For Expiry</td>
                                                    <td>{{$days." days "}}</td>
                                                </tr>
                                                @endif
                                               @else <tr>
                                                  
                                                    <td> Expired On {{date("d-F-Y",strtotime($expiry_date))}}</td>
                                                </tr>
                                                @endif
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endsection