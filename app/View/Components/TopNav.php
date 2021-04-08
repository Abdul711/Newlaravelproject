<?php

namespace App\View\Components;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class TopNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        
        if(session()->has('FRONT_USER_ID')){
            $user_type="Reg";
          $user_id=session('FRONT_USER_ID');
             }else{
                    $user_type="Non-Reg";   
                    $user_id=0;
                }
        
        
        $ip=ip_address();
        $cart_data=DB::table("carts")
        ->leftJoin("product_attributes","product_attributes.id","=","carts.attr_id")  
        ->leftJoin("products","products.id","=","carts.product_id")
        ->leftJoin("colors","colors.id","=","product_attributes.color_id")
        ->leftJoin("sizes","sizes.id","=","product_attributes.size_id")    
        ->leftJoin("categories","categories.id","=","products.category_id")
        ->leftJoin("brands","brands.id","=","products.brand_id")               
        ->select(
            "carts.qty","carts.id as cart_id","carts.attr_id as attribute_id","carts.product_id as cart_product_id",
        "product_attributes.price as product_price","product_attributes.mrp as product_market_price",
        "products.name","products.image as product_image",
        "colors.color_name as product_colors",
        "sizes.size_name as product_sizes",
        "categories.category_name as product_category",
        "brands.brands as product_brands"
        )->where(["ip_add"=>$ip])->where(["user_id"=>$user_id])->where(["user_type"=>$user_type])->get();
        $cart_data=json_decode($cart_data,true);
        $result["cart_datas"]=$cart_data;
        
        $cart_total=0;
        foreach($cart_data as $data){
        $cart_total+=$data['product_price']*$data["qty"];
        }
        $cart_data=userCart();
        $cart_data=json_decode($cart_data,true);
        $result["cart_datas"]=$cart_data;
        $cart=cartTotal();
        $result["total_item"]=$cart["total_item"];   
        $result['cart_total']=$cart["cart_total"];

        return view('components.top-nav',$result);
    }
}
