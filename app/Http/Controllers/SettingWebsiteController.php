<?php

namespace App\Http\Controllers;

use App\Models\SettingWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class SettingWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resul=DB::table("web_setting")->get();
        if(isset($resul[0])){
        $result["min_cart_amt"]=$resul[0]->min_cart_amt;
        $result["free_delivery_cart"]=$resul[0]->free_delivery_cart;
        $result["web_status"]=$resul[0]->web_status;
        $result["discount_on_first"]=$resul[0]->discount_on_first;
        $result["no_of_order"]=$resul[0]->no_of_order;
      }else{
        $result["min_cart_amt"]="";
        $result["free_delivery_cart"]="";
        $result["web_status"]="";
        $result["discount_on_first"]="";
        $result["no_of_order"]="";
      
    }

        return view('admin.web_set',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

      
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingWebsite  $settingWebsite
     * @return \Illuminate\Http\Response
     */
    public function show(SettingWebsite $settingWebsite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingWebsite  $settingWebsite
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingWebsite $settingWebsite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingWebsite  $settingWebsite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingWebsite $settingWebsite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingWebsite  $settingWebsite
     * @return \Illuminate\Http\Response
     */
      public function manage_web_process(Request $req)
     {
  
        unset($_POST['_token']);
     
$data=$_POST;
$total=DB::table('web_setting')->count();
if($total==0){
DB::table('web_setting')->insert($data);
}else{
DB::table("web_setting")->update($data);
}
 
        return redirect('admin/setting');
     }
public function destroy($id)
    {
     
    }
}
