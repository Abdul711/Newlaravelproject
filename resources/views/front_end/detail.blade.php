

<style>
*{

   box-sizing:border-box;
   font-size:22px;
}
.order_detail{
   display:block;
   float:left;

}
.user_info{
   display:block;
   float:right;

}
.amount, .coupon{
   font-weight:700;
   font-style:italic;
}
.amount_total .final_p{
   color:red;
   font-weight:800;
}
.coupon_code{
   color:red;

}
.cart_detail{

clear:both;

}
.delivery{
font-weight:800;
}
.order_title{
font-size:32px;

color:blue;
background:red;
font-weight:900;
font-variant:samll-caps;
text-align:center;
clear:both;
}
.item{
   color:yellow;
}
td{
   border:1px solid black;
   text-align:center;
   width:300px;
}
table{
   border-collapse:collapse;
}
.image_product img {
   width:200px;
height:200px;
border:1px solid green;
}
.shopping_logo{
 float:left;


}
.shop_title{
   margin-bottom:-2px;
   margin-left:24px;
   margin-top:24px;
}
.shopping_logo img{
   float:left;
}
 .aa-logo {
  float: left;
  margin-top: 2px;
  color:red;
}

 .aa-logo a {
  font-family: "Raleway", sans-serif;
  font-size: 28px;
}
 .aa-logo a:hover {  
  color: #333;
}
 .aa-logo a > span {
  display: inline-block;
  float: left;
  font-size: 50px;
  color:red;
}
 .aa-logo a p {
  display: inline-block;
  float: left;
  font-weight: bold;
  margin-bottom: 0;
  margin-left: 5px;
  margin-top: -5px;
}
 .aa-logo a p span {
  display: block;
  font-size: 12px;
  font-weight: normal;
  letter-spacing: 1.5px;
  text-transform: uppercase;
}
.aa-logo img{
   color:red;
}
.ma{
   margin-top:20px;
   margin-bottom:40px;
}
</style>
@if($orders[0]->coupon_value!=0)
<h1 class="ma"> Discounted Order</h1>
@endif
<div class="aa-logo">
                <!-- Text based logo -->
                <img src="{{public_path('storage/pdf_icon/download.png')}}">
                <a href="{{url('/')}}">
                 
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="javascript:void(0)"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
                 

<br><br><br><br><br><br>
<h1 class="order_title"> Order No # {{$orders[0]->id}}</h1>
<h3 class="order_title item"> Total Item:  {{$total_item}}</h3>
<span class="order_detail">
<p class="amount_total">  Cart Total :<span class="amount">{{$cart_total}} Rs</span>  </p>
<p class="amount_total">Delivery Charge : {{$delivery_charge}}</p>
<p class="amount_total">Gst:{{$orders[0]->gst}} Rs</p>
@if($orders[0]->coupon_value!=0)
<p class="coupon"><span class="coupon_code">Discount:{{$orders[0]->coupon_value}} Rs</span></p>
<p class="coupon">Coupon Code:<span class="coupon_code">{{$orders[0]->coupon_code}}</span> </p>
@endif
<p class="amount_total "> Amount Due:<span class="final_p">{{$amount_due}}</span></p>
  </p>
</span>
<p class="amount_total"> Payment Method :<span class="amount">{{$payment_method}}</span>
<span class="user_info">
<p class="amount_total"> City :<span class="amount">{{$cityname}}</span>  </p>
<p class="amount_total"> Customer Name :<span class="amount">{{$orders[0]->customer_name}}</span>  </p>
<p class="amount_total"> Customer Email :<span class="amount">{{$orders[0]->customer_email}}</span>  </p>
<p class="amount_total"> Customer Mobile :<span class="amount">{{$orders[0]->customer_phone}}</span>  </p>
<p class="amount_total"> Order Date :<span class="amount">{{date("d-M-Y",strtotime($orders[0]->created_at))}}</span>  </p>
<p class="amount_total"> Order Time :<span class="amount">{{date("h:i a",strtotime($orders[0]->created_at))}}</span>  </p>

</span>
<br><br>
<div class="cart_detail">

Delivery Address : <p class="delivery">{{$orders[0]->customer_address}}</p>
<h3 class="order_title item">Cart Detail</h3>

<table class="ordors_detail">  
<thead>
<tr>
<th>

</th>
<th>

</th>
<th>Qty</th>
<th>Per Unit Price</th>
<th>Total</th>
</tr>
</thead>
<tbody>
@foreach($order_details as $order_detail)
        <tr>
      <td width="50%" class="image_product"><img src="{{public_path('storage/media/'.$order_detail->image)}}"></td>
        <td>
        {{$order_detail->name}}
      @if($order_detail->color_name!="")
      <p>Color:{{$order_detail->color_name}}</p>
      @endif
      @if($order_detail->size_name!="")
      <p>Size:{{$order_detail->size_name}}</p>
      @endif
      @if($order_detail->brands!="")
      <p>Brand:{{$order_detail->brands}}</p>
      @endif
        </td>
        <td width="10%">
        {{$order_detail->qty}}
        </td>
        <td width="20%">
        {{$order_detail->price}} Rs 
        </td>
        <td  width="20%">
        {{$order_detail->price * $order_detail->qty}} Rs 
        </td>
        </tr>
        @endforeach
</tbody>
</table>

</div>