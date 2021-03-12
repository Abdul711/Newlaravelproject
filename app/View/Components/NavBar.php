<?php

namespace App\View\Components;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class NavBar extends Component
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
        $data_c=DB::table('categories')->where(['parent_category_id'=>'0'])->get();
        $data_c=json_decode($data_c,true);

        $result['categories']=$data_c;

          
        foreach($data_c as $vl){
           $ci= $vl['id'];
          $sub_data=DB::table('categories')->where(['parent_category_id'=>$ci])->get();
          $data_c=json_decode($sub_data,true);
              $result["sub_category"][$vl['id']]=$data_c;

        } 
        
                

          
        $result['data']='All';
      /*  prx($result)*/;

        return view('components.nav-bar',$result);
    }
}
