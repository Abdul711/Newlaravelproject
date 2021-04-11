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
    success:function(result){
    alert(result);
    console.log(result);
  if(result.status=="success"){
    swal("Congratulations!",result.msg,result.status);
  }
    if(result.status=="error"){
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
  if(user_password==""){
    swal("Oop!","Please Enter Password","error");
    return false;
  }


 if(!valid_email.test(user_email)){
        swal("Oops!","Please Provide Correct Email Address","error");

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
delivery_charge_text="";
if(response.status=="error"){
   swal("Oops! Something Went Wrong",response.msg,response.status);
   $(".cart_total").html(response.cart_total+" Rs ");
      $(".gst").html(response.gst+" Rs ");
                 $(".gst").html(response.gst+" Rs ");

           
             $(".final").html(response.final_price+" Rs ");

 
}else{
  $('#frmAddToCart').trigger('reset');
  if(response.delivery_charge>0){
delivery_charge_text=response.delivery_charge+" Rs ";

  }else{
delivery_charge_text="Free Delivery";
  }
  $(".delivery_charge").html(delivery_charge_text);
  $(".cart_total").html(response.cart_total+" Rs ");
  $(".gst").html(response.gst+" Rs ");
  $(".final").html(response.final_price+" Rs ");
add_detail();
swal("Congratulations",response.msg,response.status);
}
  }
});





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
$("#color_id").val(color_id);

$("#product_id").val(product_id);
        

  jQuery('.colors').css('border','0px solid black');
  jQuery('.color_'+color_id).css('border','3px solid black');

}
function showColor(size){
  
  $(".product_color").hide();
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
      
   html_cart+='<li>';
   html_cart+='<a class="aa-cartbox-img" href="#"><img src="'+PRODUCT_IMAGE+'/'+arrVal.product_image+'" alt="img"></a>';
   html_cart+='<div class="aa-cartbox-info">';
   html_cart+='<h4><a href="#">'+arrVal.name+'</a></h4><p><b>Color:</b><strong>'+arrVal.product_colors+'</strong></p><p><b>Size:</b><strong>'+arrVal.product_sizes+'</strong></p><p>'+arrVal.qty+' * Rs '+price+'</p></div></li>';
});
path=FRONT_PATH+"/cart";
   html_cart+='<li><span   class="aa-cartbox-total-title">Total</span> <span class="aa-cartbox-total-price">Rs<span class="c_p">'+param.cart_total+'</span></span></li>';
        html_cart+='</ul><a  class="aa-cartbox-checkout aa-primary-btn" href="'+path+'">Cart</a>';

        $(".aa-cartbox-summary").html(html_cart);
 

}else{
  html_cart+='<li>No Item In Cart</li>';

  $(".checkout").remove();
  $(".aa-cartbox-summary").remove();
  $("#no").show();

}

$(".aa-cart-notify").html(total);

}
  });


}

function updateCart(color_id,size_id,product_id,attr_id,price){
/*add_to_cart()*/;

qty=$('#qty'+attr_id).val();
$("#pqty").val(qty);
$("#size_id").val(size_id);
$("#color_id").val(color_id);
$("#product_id").val(product_id);
if(qty==0){
$("#box"+attr_id).remove();
}

add_to_cart();
 add_detail();
totalPrice=$(".c_p").html();

$("#price"+attr_id).html('Rs'+qty*price);

}
function deleteCart(color_id,size_id,product_id,attribute_id){
qty=0;
$("#pqty").val(qty);
$("#size_id").val(size_id);
$("#color_id").val(color_id);
$("#product_id").val(product_id);

add_to_cart();
$("#box"+attribute_id).remove();
}
function totalPrice(){
alert("Hello");
}
$(".apply_coupon").click(function(e){
  e.preventDefault();
coupon_code=$("#coupon_code").val();
if(coupon_code!=""){

path=FRONT_PATH+"/place_coupon/"+coupon_code;

$.ajax({
   url:path,
   method:"get",

   success:function(res){
        min_cart=parseInt(res.min_cart);

         console.log(res);
         if(res.status=="success"){
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
                             if(res.delivery_charge==0){
delivery_charge_text="Free Delivery";
                             }else{
delivery_charge_text=res.delivery_charge+"Rs";
                             }                           
                             $(".delivery_charge").html(delivery_charge_text);
                                        $("#delivery_charge").val(res.delivery_charge);
         title_msg="Congratulations";
         }else{
                title_msg="Oops! Something Went Wrong";
         }
    
         if(res.wallet>=res.final_price){
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
        if(customer_zip=="" || customer_dis=="" || customer_city=="0" ||customer_address=="" || customer_payment==""){
swal("Opps!","Please Fill The Dispatched Order Form","error");
return false;
        }
 $("#customer_name").val(customer_name);
  $("#customer_email").val(customer_email);
    $("#customer_phone").val(customer_phone);
      $("#customer_address").val(customer_address);
        $("#customer_city").val(customer_city);
   $("#customer_dis").val(customer_dis);
      $("#customer_zip").val(customer_zip);
        $("#customer_payment").val(customer_payment);
      form_data=$("#orderSubmit").serialize();
      alert(form_data);
path=FRONT_PATH+"/place_order";
$.ajax({
  url:path,
  method:"post",
  data:form_data,
  success:function(response){
    alert(response);
        console.log(response);
if(response.status=="error"){
  swal("Oops!",response.msg,response.status);
}else{
    swal("Congratulations",response.msg,response.status);
   window.location.href="/thank";
}

      
  }
});


});
function sizeSelect(size,product){
  
  $(".productColor").hide();
  $('.ColorSize'+size).show();

   jQuery('.size_link').css('border','2px solid grey');
       jQuery('#size_'+size+product).css('border','2px solid grey');
  jQuery('#size_'+size+product).css('border','2px solid black');

    $("#size_id").val('');
  $("#size_id").val(size);

}
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
 $("#search_product").val(search_item);
 

}
function qtyTake(productId){
                         
  qty=$("#qtyProduct").val();
if(qty==""){
  swal("Oops!","Select Qty","error");
  return false;
}
  $("#pqty").val(qty);
   $("#product_id").val(productId);
   add_to_cart();
}
