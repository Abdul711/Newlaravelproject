/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
      
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
   
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

  
  jQuery(function(){
    if($('body').is('.productPage')){
     var skipSlider = document.getElementById('skipstep');

     var filter_price_start=jQuery('#filter_price_start').val();
     var filter_price_end=jQuery('#filter_price_end').val();
     
     if(filter_price_start=='' || filter_price_end==''){
      var filter_price_start=1000;
      var filter_price_end=19000;
     }

      noUiSlider.create(skipSlider, {
          range: {
              'min': 900,
              '10%': 1000,
              '20%': 3000,
              '30%': 5000,
              '40%': 7000,
              '50%': 9000,
              '60%': 11000,
              '70%': 13000,
              '80%': 15000,
              '90%': 17000,
              'max': 19000
          },
          snap: true,
          connect: true,
          start: [filter_price_start, filter_price_end]
      });
      // for value print
      var skipValues = [
        document.getElementById('skip-value-lower'),
        document.getElementById('skip-value-upper')
      ];

      skipSlider.noUiSlider.on('update', function( values, handle ) {
        skipValues[handle].innerHTML = values[handle];
      });
    }
  });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});





$("#register_user").submit(function (e) { 
  e.preventDefault();
  var user_email=$('#user_email_reg').val();
    var user_mobile=$('#user_mobile_reg').val();
      var user_password=$('#user_password_reg').val();
        var user_name=$('#user_name_reg').val();
  if(user_email==""){
        swal("Oops!","Please Provide Email Address","error");

   return false;
  }
  valid_email=/[A-Za-z0-9_.]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z]{3,6}$/;

  if(user_name==""){
        swal("Oops!","Please Provide User Name","error");
     return false;
  }
  if(user_mobile==""){
        swal("Oops!","Please Provide Mobile Number","error");

   return false;
  }
    if(user_password==""){
        swal("Oops!","Please Provide Password","error");

   return false;
  }
    if(!valid_email.test(user_email)){
        swal("Oops!","Please Provide Correct Email Address","error");

   return false;
  }
  jQuery.ajax({
    url:'registration_process',
    data:jQuery('#register_user').serialize(),
    type:'post',
    beforeSend:function(){
      $(".wait").html('Please Wait ...');
    },
    success:function(result){
    alert(result);
    console.log(result);
  if(result.status=="success"){
    swal("Congratulations!",result.msg,result.status);
    window.location.href=FRONT_PATH+"/register_success";
  }
    if(result.status=="error"){
          $(".wait").html(result.msg);
    swal("Oops!",result.msg,result.status);
  }   
    }
  });



});
$('.login-user').submit(function (e) { 
  e.preventDefault();
  var user_email=$("input[name='user_login_email']").val();
   var user_password=$("input[name='user_login_password']").val();
   valid_email=/[A-Za-z0-9_.]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z]{3,6}$/;
  if(user_email==""){
    swal("Oop!","Please Enter Email Address","error");
    return false;
  }




     form_data=$(this).serialize();
    jQuery.ajax({
    url:'login_process',
    data:form_data,
    type:'post',
    success:function(result){
    alert(result);
    console.log(result);
          if(result.status=="success"){
            swal("Congratulations",result.msg,result.status);

          } if(result.status=="error"){
            swal("Oops",result.msg,result.status);
      
          }
         links=result.link;
             
    }
  });
      

});
$("#send_link").submit(function (e) { 
  e.preventDefault();
  var form_data=$(this).serialize();
  user_reset_pass_email=$("#user_reset_pass_email").val();
     valid_email=/[A-Za-z0-9_.]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z]{3,6}$/;
  if(user_reset_pass_email==""){
        swal("Oops!","Please Provide  Email Address","error");

   return false;
  }
   if(!valid_email.test(user_reset_pass_email)){
        swal("Oops!","Please Provide Correct Email Address","error");

   return false;
  }
  jQuery.ajax({
    url:'forget_password',
    data:form_data,
    type:'post',
    success:function(result){
    alert(result);
    console.log(result);
    
          

    }
  });
  alert(form_data);
});
$("#password_reset").submit(function (e) { 
  e.preventDefault();
  form_data=$(this).serialize();
 var Password= $("#new_pass").val();
  var CPassword= $("#c_new_pass").val();
    var otp=$("#otp").val();
    var valid_otp=/^[0-9]{4}$/;
    var vaild_password=/^[A-Za-z]{4,}[0-9]{1,}$/;
 if(Password==""){
   swal("Oop!","New Password Must Be Filled Out","error");
   return false;
 }
  if(CPassword==""){
   swal("Oop!","Confirm New Password Must Be Filled Out","error");
   return false;
 
 }
 if(!vaild_password.test(Password)){
      swal("Oop!"," Password Must Be AlphaNumeric With Atleast Four AlphaBet And One Number Out","error");
   return false;
 }
 if(CPassword!=Password){
     swal("Oop!","Confirm Password Must Be Similar To New Password","error");
   return false;
 
 }
 if(otp==""){
        swal("Oop!","OTP Must Be Filled Out","error");
   return false;
 }
 if(!valid_otp.test(otp)){
         swal("Oop!","Invalid OTP! OTP Must Be Four Digit Number","error");
   return false;
 }
 path=FRONT_PATH+"/passwordreset";
 jQuery.ajax({
    url:path,
    data:form_data,
    type:'post',
    success:function(result){
    alert(result);
    console.log(result);
       if(result.status=="success"){
         swal("Congratulations",result.msg,result.status);
        
       }else{
          swal("Oops!",result.msg,result.status); 
       }  

    }
  });


});
function add_to_cart(){

/*PRODUCT_IMAGE*/

path=FRONT_PATH+"/add_cart";

form_data=$('#frmAddToCart').serialize();
var qty=$("#pqty").val();
if(qty==""){
  swal("OOps","Please Select Qty","error");
  return false;
}
$.ajax({
  type: "post",
  url:path,
  data:form_data,

  success: function (response) {
console.log(response);
alert(response);
delivery_charge_text="";
if(response.status=="error"){
  swal("Oops!",response.msg,"error");
   $(".cart_total").html(response.cart_total+" Rs ");
      $(".gst").html(response.gst+" Rs ");
                 $(".gst").html(response.gst+" Rs ");
$(".points").html(response.cart_point);

  if(response.delivery_charge>0){
delivery_charge_text=response.delivery_charge+" Rs ";

  }else{
delivery_charge_text="Free Delivery";
  }  
   $(".delivery_charge").html(delivery_charge_text);         
             $(".final").html(response.final_price+" Rs ");

 
}else{
  swal("Congratulations",response.msg,"success");

 
  if(response.delivery_charge>0){
delivery_charge_text=response.delivery_charge+" Rs ";

  }else{
delivery_charge_text="Free Delivery";
  }
  $(".points").html(response.cart_point);
  $(".delivery_charge").html(delivery_charge_text);
  $(".cart_total").html(response.cart_total+" Rs ");
  $(".gst").html(response.gst+" Rs ");
  $(".final").html(response.final_price+" Rs ");

  $(".product_color").css('display','inline-block');
     $(".productColor").css('display','inline-block');
     $('#frmAddToCart').trigger('reset');

}
  }
});


add_detail();


}
 function change_color(){
alert("");
}

$("#qty").change(function(){
    qty=$(this).val();
    $("#pqty").val(qty);
    alert(qty);
});
function change_product_color_image(color_id,product_id){
alert("color_id"+color_id+"product_id"+product_id);
$("#color_id").val('');
$("#product_id").val('');

if(color_id==""){
  color_id="No_color";
}else{
  color_id=color_id;
}
$("#color_id").val(color_id);

$("#product_id").val(product_id);
        

  jQuery('.colors').css('border','0px solid black');
  jQuery('.color_'+color_id).css('border','3px solid black');

}
function sizeSelect(size,product){
  
  $(".productColor").css('display','none');
  $('.ColorSize'+size).show();

   jQuery('.size_link').css('border','2px solid grey');
       jQuery('#size_'+size+product).css('border','2px solid grey');
  jQuery('#size_'+size+product).css('border','2px solid black');
    
    $("#size_id").val('');
  $("#size_id").val(size);

}
function showColor(size){

  $(".product_color").css('display','none');
  $('.size_'+size).show();
   jQuery('.size_link').css('border','1px solid #ddd');
  jQuery('#size_'+size).css('border','1px solid black');
  $("#size_id").val(size);

}

function  add_detail() {  

path=FRONT_PATH+"/cart_detail";
  $.ajax({
method:"get",
url:path,
success:function (param) {  
console.log(param);

     var html_cart='<ul>';
total=param.total_item;

if(total>0){
$.each(param.data, function (arrKey,arrVal) { 
 disc=arrVal.is_discounted;
 if(disc==1){
 disc_amount=(arrVal.discount_amount/100)*arrVal.product_price;
 }else{
   disc_amount=0;
 }

  price=arrVal.product_price-disc_amount;
  
   html_cart+='<li class="cartBoxDet'+arrVal.cart_id+'">';
   html_cart+='<a class="aa-cartbox-img" href="#"><img src="'+PRODUCT_IMAGE+'/'+arrVal.product_image+'" alt="img"></a>';
   html_cart+='<div class="aa-cartbox-info">';
   html_cart+='<h4><a href="#">'+arrVal.name+'</a></h4>';
   if(arrVal.product_colors!=null){
  html_cart+='<p><b>Color:</b><strong>' +arrVal.product_colors+'</strong></p>';
   }
    if(arrVal.product_sizes!=null){
  html_cart+=' <p><b>Size:</b><strong>'+arrVal.product_sizes+'</strong></p>';
    }
    d=arrVal.cart_id;
    qty=arrVal.qty;
   point_cart=arrVal.cart_point;
  html_cart+='<p>'+arrVal.qty+"* Rs"+price;
   html_cart+='<a class="aa-remove-product" href="javascript:void(0)" onclick="DeleteCartItem('+d+','+qty+','+price+','+point_cart+')" ><span class="fa fa-times"></span></a>';
      html_cart+='</li>';
});


path=FRONT_PATH+"/cart";
   html_cart+='<li><span   class="aa-cartbox-total-title">Total</span> <span class="aa-cartbox-total-price">Rs<span class="c_p">'+param.cart_total+'</span></span></li>';
        html_cart+='</ul><a  class="aa-cartbox-checkout aa-primary-btn" href="'+path+'">Cart</a>';
        $(".aa-cartbox-summary").html(html_cart);
}
else{
  $(".cart-view-total").css('display','none');
    $(".checkout").css('display','none');
    $("#no").show();
     html_cart+='<li>No Item In Cart</li>';
       $(".aa-cartbox-summary").html(html_cart);
}
      
 



$(".aa-cart-notify").html(total);

}
  });


}
function deleteCart(color_id,size_id,product_id,attr_id,cart_id){
  if(color_id==""){
     color_id="no_color";
   }if(size_id==""){
        size_id="no_size";
   }

qty=0;
$("#pqty").val(qty);
$("#size_id").val(size_id);
$("#color_id").val(color_id);
$("#product_id").val(product_id);

$("#box"+cart_id).remove();
add_to_cart();
}
function updateCart(color_id,size_id,product_id,attr_id,price){
   if(color_id==""){
     color_id="no_color";
   }if(size_id==""){
        size_id="no_size";
   }

qty=$('#qty'+attr_id).val();
qty=parseInt(qty);
$("#pqty").val(qty);
$("#size_id").val(size_id);
$("#color_id").val(color_id);
$("#product_id").val(product_id);
if(qty==0){
$("#box"+attr_id).remove();
}

$("#price"+attr_id).html('Rs'+qty*price);
add_to_cart();



}

function totalPrice(){
alert("Hello");
}
function remove_coupon(){
  alert("Coupon Removed");
 $(".applied_coupon_box").hide();
  $(".apply_coupon_box").show();
           $(".cart_promo").addClass('coupon_hide');
$(".cart_promo").removeClass('coupon_show');
$.ajax({
  url:FRONT_PATH+"/remove_coupon",
  method:"get",
  success:function(res){
    alert(res);
    console.log(res);

    swal("Congratulations","Coupon Removed","success");
        
             $(".tax_per").html(res.tax_value);
                  $(".tax_amt").html(res.gst);
                  $("#gst").val(res.gst);
                  $("#coupon_id").val(res.COUPONCODE);
                      $("#final_price").val(res.final_price);
                              $(".final_price").html(res.final_price);
                              $(".couponcode").html(res.COUPONCODE);
                          
            $("#coupon_value").val(res.discount);
                          
                             if(res.delivery_charge==0){
delivery_charge_text="Free Delivery";
                             }else{
delivery_charge_text=res.delivery_charge+"Rs";
                             }                           
                             $(".delivery_charge").html(delivery_charge_text);
                                        $("#delivery_charge").val(res.delivery_charge);
         title_msg="Congratulations";


         $(".tax_per").html(res.tax_value);
                  $(".tax_amt").html(res.gst);
                  $("#gst").val(res.gst);
                  $("#coupon_id").val(res.COUPONCODE);
                      $("#final_price").val(res.final_price);
                            $("#coupon_id").val(res.COUPONCODE);
                      $("#final_price").val(res.final_price);
                              $(".final_price").html(res.final_price);
                              $(".couponcode").html(res.COUPONCODE);
                                 $(".apply_coupon_box").addClass('show_coupon_box');
                                  $(".applied_coupon_box").addClass('hide_coupon_box');
  }
})
}
$(".apply_coupon").click(function(e){
  e.preventDefault();
coupon_code=$("#coupon_code").val();
if(coupon_code!=""){

path=FRONT_PATH+"/place_coupon/"+coupon_code;

$.ajax({
   url:path,
   method:"get",
beforeSend:function(){
$(".waits").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button> Please Wait While Applying Coupon</div>");
},
   success:function(res){
        min_cart=parseInt(res.min_cart);

         console.log(res);
         if(res.status=="success"){
           $(".apply_coupon_box").hide();
         $(".cart_promo").removeClass('coupon_hide');
$(".cart_promo").addClass('coupon_show');
         $(".after_promo").html(res.cart_promo);
             $(".discount").html(res.discount);
             $("#coupon_value").val(res.discount);
             $(".tax_per").html(res.tax_value);
                  $(".tax_amt").html(res.gst);
                  $("#gst").val(res.gst);
                  $("#coupon_id").val(res.COUPONCODE);
                      $("#final_price").val(res.final_price);
                              $(".final_price").html(res.final_price);
                              $(".couponcode").html(res.COUPONCODE);
                              $(".applied_coupon_box").html("Coupon Code "+res.COUPONCODE+" Applied Successfully <span class='fa fa-times' onclick='remove_coupon()'></span>");
                           $(".applied_coupon_box").css("color","red");
                               $(".applied_coupon_box").css("fontWeight","800");
                                $(".applied_coupon_box").css('display','block');
                             if(res.delivery_charge==0){
delivery_charge_text="Free Delivery";
                             }else{
delivery_charge_text=res.delivery_charge+"Rs";
                             }                           
                             $(".delivery_charge").html(delivery_charge_text);
                                        $("#delivery_charge").val(res.delivery_charge);
         title_msg="Congratulations";
            $(".waits").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>"+res.msg+"</div>");
         }else{
                title_msg="Oops! Something Went Wrong";
                $(".waits").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>"+res.msg+"</div>");
         }
    
         if(res.wallet>0){
 $(".wallet").prop("checked",true);
            $(".wallet").prop("disabled",false);
     $(".wallet_msg").text('');
         
              
         }else{
            $(".wallet").prop("checked",false);
            $(".wallet").prop("disabled",true);
                 $(".wallet_msg").text('Low Wallet');
                 $(".wallet_msg").css('color',"red");
         }
    
              swal(title_msg,res.msg,res.status);                       
   }
});
}else{
  swal("Oops!","Please Enter Coupon Code","error");

}
});
$(".delivery_type").change(function(e){
alert($(this).val());
var delivery_type=$(this).val();
if(delivery_type=="scheduled"){
  $(".delivery_select").show();
}else{
    $(".delivery_select").hide();
}
$("#delivery_type").val(delivery_type);
}); 
$('.place_order').click(function(e){
  e.preventDefault();
 customer_name=$("#name").val();
customer_email=$("#email").val();
customer_phone=$("#phone").val();
customer_address=$("#address").val();
customer_dis=$("#dis").val();
customer_city=$("#city").val();
customer_zip=$("#zip").val();
                customer_payment=$("input[name='optionsRadios']:checked").val();
     deliveryType=$("input[name='deliveryType']:checked").val();
    delivery_time=$("#delivery_ti").val();
  alert(deliveryType);
    if(deliveryType=="scheduled" && delivery_time==""){
      swal("Oops!","Please Select Time For Scheduled Delivery","error");
      return false;

    }
    if(deliveryType=="scheduled"){
      delivery_tim=delivery_time;
    }else{
now=new Date();
delivery_tim=now.getTime();
    new_date=new Date(delivery_tim);
    month=new_date.getMonth()+1;
      dateToday=new_date.getDate();

    new_date=new_date.getFullYear()+"-"+"0"+month+"-"+dateToday+"T"+new_date.getHours()+":"+new_date.getMinutes();

    delivery_tim=new_date;
    }
    $("#delivery_time").val(delivery_tim);
 $("#customer_name").val(customer_name);
  $("#customer_email").val(customer_email);
    $("#customer_phone").val(customer_phone);
      $("#customer_address").val(customer_address);
        $("#customer_city").val(customer_city);
   $("#customer_dis").val(customer_dis);
      $("#customer_zip").val(customer_zip);
        $("#customer_payment").val(customer_payment);
            $("#delivery_type").val(deliveryType);
      form_data=$("#orderSubmit").serialize();
    
path=FRONT_PATH+"/place_order";
        if(customer_zip=="" || customer_dis=="" || customer_city=="0" ||customer_address=="" || customer_payment==""){
swal("Opps!","Please Fill The Dispatched Order Form","error");
return false;
        }


$.ajax({
  url:path,
  method:"post",
  data:form_data,
  beforeSend:function(){
    $(".wait").html('Please Wait..');
  },
  success:function(response){
    alert(response);
        console.log(response);
       $(".wait").html(response.msg);
if(response.status=="error"){
  swal("Oops!",response.msg,response.status);
}else{
    swal("Congratulations",response.msg,response.status);
   window.location.href="/thank";
}

      
  }
});


});

function sort_by(){
$("#sort").val($("#sort_by_value").val());
$("#categoryFilter").submit();
}
function ShowProduct(color){
 
  $(".remain").css('border','0px solid green');
  $("#product_color-"+color).css('border','4px solid green');
  $("#colors_id").val(color);
  $("#categoryFilter").submit();
}
function selectColor(color,product){
  
  jQuery('#color_'+color+product).css('border','0px solid black');

    if(color==""){
      color="no_color";
    }
  jQuery('#color_'+color+product).css('border','4px solid black');
  $(".productColor").css('0px solid black');
       $("#color_id").val('');
  $("#color_id").val(color);


}
function sort_price_filter(){
  var low_value=$("#skip-value-lower").html();
low_value=parseInt(low_value);
  $("#filter_price_start").val(low_value);
  var high_value=  $("#skip-value-upper").html();
high_value=parseInt(high_value);
  $("#filter_price_end").val(high_value);
   $("#categoryFilter").submit();
}
 function search_product(){
search_item=$("#search_item").val();
 alert(search_item);

 

}
$("#sear_pro").click(function(e){
  e.preventDefault();
 var ser=$("#search_product").val();
 alert(ser);
 if(ser!=""){
   window.location.href=FRONT_PATH+"/search_item/"+ser;
 }
  
});
function qtyTake(productId,color,size){
             if(color==""){
               color="no_color";
             }     
                    if(size==""){
               size="no_size";
             }             
  qty=$("#qtyProduct").val();
  qty="1";
var   size_id=$("#size_id").val();
  var color_id=$("#color_id").val();
   
         if(color!="no_color" && color_id==""){
           swal("Oops!","Please Select Color","error");
           return false;
         }
 if(size!="no_size" && size_id==""){
           swal("Oops!","Please Select Size","error");
                 return false;
         }

if(qty==""){
  swal("Oops!","Select Qty","error");
  return false;
}
 if(size=="no_size"){
   $("#size_id").val(size);
 }
$("#pqty").val(qty);
   $("#product_id").val(productId);
   add_to_cart();


 
}
function add_cart(size,color){
   if(size==""){
    size="no_size";
   }if(color==""){
     color="no_color";
   }
   color_id=$("#color_id").val();
     size_id=$("#size_id").val();
     if(size!="no_size" && size_id==""){
       swal("Oops!","Please Select Size","error");
       return false;
     }
          if(color!="no_color" && color_id==""){
       swal("Oops!","Please Select Color","error");
       return false;
     }

   add_to_cart();
}
$('.product_rating').click(function(){
rating=$(this).data('index');
product_id=$(this).data('product_id');



$("#rating").val('');
$("#rating").val(rating);

});







 $('.product_rating').mouseenter(function(){
    var index= $(this).data('index');
    var product_id=$(this).data('product_id');
    remove_background(product_id);
   for(count=1; count<=index; count++){
  $('#'+product_id+count).css('color','#ffcc00');
    }
              
  });

    function  remove_background(product_id){
                  for(count=1; count<=5; count++){
                  $('#'+product_id+count).css('color','#ccc');
                  }
              
                }
      $('.rating').mouseleave(function(){
                  var index= $(this).data('index');
                var product_id=$(this).data('product_id');
                remove_background(product_id);
                for(count=1; count<=index; count++){
                  $('#'+product_id+count).css('color','#ccc');
                }
              
                });

$('.su').click(function(e){
e.preventDefault();
message=$('#message').val();
name=$('#name').val();
email=$('#email').val();
dateToday=new Date();
todayDate=dateToday.toLocaleString("default",{month:"long"});
todayweek=dateToday.toLocaleString("default",{weekday:"long"});

newDate=todayDate+" "+dateToday.getDate()+" , "+" "+dateToday.getFullYear();
total_review=$(".total_review").html();
total_review=parseInt(total_review);
total_review=total_review+1;
$(".total_review").html(total_review);
$("#r").val($("#message").val());
$("#review_email").val(email);
rating =$("#rating").val();
    html_cart='';
   html_cart+='<li>';
    html_cart+='<div class="media">';
   html_cart+='<div class="media-left">';
        html_cart+='</div>';
        html_cart+='<div class="media-body">';
        html_cart+='<h4 class="media-heading"><strong>'+name+'</strong> - <span>';
        html_cart+=newDate+' '+todayweek+'</span></h4>';
           html_cart+='<div class="aa-product-rating">';
           rated=rating;
   
           remaining=5-rated;
           for(i=1; i<=rated; i++){
                html_cart+='<span class="fa fa-star"></span>';
           }
           if(remaining>0){
                  for(i=1; i<=remaining; i++){
                html_cart+='<span class="fa fa-star-o"></span>';
           }
           }
                   html_cart+='</div>';
                         html_cart+='<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>';
                         html_cart+='<p>'+$("#r").val()+"</p>";
                           html_cart+='</div>';
                       html_cart+='</div>';
                     html_cart+='</li>';
       $("#productR").append(html_cart);
 
$("#review_name").val(name);


path=FRONT_PATH+"/review_rating";
product_id=$("#pid").val();
$(".no_review").hide();
$.ajax({
url:path,
data:$("#ReviewAndRating").serialize(),
method:"post",
beforeSend:function(){
  $(".wait").html("Please Wait ...");
},
success:function(response){
    $(".wait").html(response.message);
  swal("Dear User",response.message,response.status);
}
});
});
function readd(id){
add_detail();
alert(FRONT_PATH+"/readd/"+id);

$.ajax({
url:FRONT_PATH+"/readd/"+id,
method:"get",
success:function(response){
  add_detail();
  alert(response);
  console.log(response);
alert(FRONT_PATH+"/readd/"+id);

}
});
}

$(".goge").click(function(){
var po=$("input[name='user_client_password']").prop("type");
$(this).toggleClass("fa fa-eye fa fa-eye-slash");
if(po=="password"){
  $("input[name='user_client_password']").prop("type","text");


}
if(po=="text"){
    $("input[name='user_client_password']").prop("type","password");
      
    



}

});
$(".login_customer").click(function(e){
  e.preventDefault();

 var password=$("input[name='user_client_password']").val();
  var email=$("input[name='user_client_email']").val();
       if(email==""){
         swal("Oops","Please Fill The Email","error");
         return false;
       }
   if(password==""){
         swal("Oops","Please Fill The Email","error");
    return false;
   }
         path=FRONT_PATH+"/loginFront_user";
         var form_data=$(".login_front_user").serialize();
     $.ajax({
     method:"POST",
url:path,
data:form_data,
beforeSend:function(){
$(".waiting_msg").html('Please Wait ...');
},
success:function(data_reply){
$(".waiting_msg").html(data_reply.msg);
  console.log(data_reply);
           if(data_reply.status=="error"){
       swal("Oops",data_reply.msg,"error");
           }

      if(data_reply.status=="success"){
        setInterval(function() {
            window.location.href=window.location.href;
        }, 6000);
      }


}

     });
});

$("#subscribe").click(function(e){
  e.preventDefault();
     path=FRONT_PATH+"/register_subscriber";
form_data=$("#subscribers").serialize();
email=$("#subs_email").val();
if(email==""){
  swal("Ops","Somethinng Wrong","error");
  return false;
}
alert(form_data);
     $.ajax({
     method:"POST",
url:path,
data:form_data,
success:function(data_reply){
  alert(data_reply);
  console.log(data_reply);


      if(data_reply.status=="success"){
        setInterval(function() {
            window.location.href=window.location.href;
        }, 6000);
      }


}

     });
});
$("#sendQuery").click(function(e){
  e.preventDefault();
  var user_name=$("input[name='query_user_name']").val();
   var user_email=$("input[name='query_email']").val();
    var user_mobile=$("input[name='query_mobile']").val();
     var user_subject=$("input[name='query_subject']").val();
      var user_message=$("input[name='query_message']").val();
   var formData= $("#queryForm").serialize();
 
         if(user_name!="" &&  user_email!="" && user_mobile!="" &&  user_subject!=""  && user_message!=""){
              
      $.ajax({
        url:FRONT_PATH+"/contactus",
        method:"post",
        data:formData,
        beforeSend:function(){
          $("#contactError").css("color","red");
           $("#contactError").html("Sending Please Wait...");
           $("#sendQuery").prop("disabled",true);

        },
        success:function(data_reply){
console.log(data_reply);
 $("#contactError").css("color","red");
           $("#contactError").html("");
                $("#sendQuery").prop("disabled",false);
                  $("#contactError").css("color","red");
           $("#contactError").html("Query Send ");
        }
      });

         }else{
             $("#contactError").css("color","red");
           $("#contactError").html("* All Field Required");
         }
});
function addItem(ProductID,size_name,color){


var size=$("#SizeProduct"+ProductID+":checked").val();
var color_name=$("#SizeProduct"+ProductID+":checked").data('color');
alert(color_name);

    if(size_name!= "" && size == undefined ){
      swal("Oop!","Please Select Size","error");
      return false;
    }
if(size_name==""){
  size="no_size";
}
    if(color!= "" && color_name == undefined ){

      color_name=color;
    }
 

   
   $("#size_id").val(size);
      $("#color_id").val(color_name);
          $("#product_id").val(ProductID);
          qty=1; 
          $("#pqty").val(qty);

   add_to_cart();




}
function deleteCartAtt(cartId){
  path=FRONT_PATH+"/delete_cart/"+cartId;
  $.ajax({
url:path,
method:"get",
success:function(dataReply){


}
  });

}
function DeleteCartItem(attr_id,qty,price,point){

var cart_total=$('.c_p').html();
cart_total=parseInt(cart_total);
total_item=$('.aa-cart-notify').html();
finalPrice=$(".final_price").html();
finalPrice=parseInt(finalPrice);
total_item=parseInt(total_item);
total_item=total_item-1;
$('.aa-cart-notify').html(total_item);

Total=qty*price;
finalPrice=finalPrice-Total;
$(".final_price").html(finalPrice);
cart_total_after_remove=cart_total-Total;
$('.c_p').html(cart_total_after_remove);
$(".total_cart").html(cart_total_after_remove);
$(".checkout"+attr_id).remove();
$(".cartBoxDet"+attr_id).remove();
$("#box"+attr_id).remove();
             
points=$(".points").html();
points=parseInt(points);
$(".points").html(points-point);
/*add_detail();*/
dataD=deleteCartAtt(attr_id);
if(total_item<=0){
   $(".cart-view-total").css('display','none');
    $(".checkout").css('display','none');
    $("#no").show();
    $(".place_order").css('display','none');
          curremtLocation=window.location.href;
       curremtLocation=curremtLocation.substr(22);
       curremtLocation=curremtLocation.replace('#','');
          alert(curremtLocation);
     html_cart='No Item In Cart';
       $(".aa-cartbox-summary").html(html_cart);
       if(curremtLocation=="checkout"){
         window.location.href="/";
       }

}


}


