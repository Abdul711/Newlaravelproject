<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(session()->has('ADMIN_LOGIN')){
          return redirect('admin/dashboard');
       }else{
         return view('admin.login');
      /*  return redirect('admin');*/
       }
   

     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        //
        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
                 'password'=>'required|regex:/[A-Za-z]{3,}[0-9]{1,}$/',
             
                 'email'=>'required|email',
              
           ],[
        
           'email.required'=>'Email Address Must be Provided',
           'email.email'=>'Correct Email Address Must Be Provided',
           'password.required'=>'Password Must be Provided',
            'password.regex'=>'Password Must Atleast 3 Alphabet With atleast one number'
           ]);   
          
             if ($validator->fails()) {
              return redirect('admin')
                          ->withErrors($validator)
                          ->withInput();
          }else{
           $password= $request->post('password');
             $email= $request->post('email');
          
           $result=Admin::where(['email'=>$email])->get();
              if(isset($result['0']->id)){
                print_r($result['0']->id);
                print_r($result['0']->password);
                $db_password=$result['0']->password;
                if($password===$db_password){
                    $request->session()->put('ADMIN_LOGIN',true);
                    $request->session()->put('ADMIN_ID',$result['0']->id);
                    $request->session()->put('ADMIN_EMAIL',$result['0']->email);
                    return redirect('admin/dashboard');
                }else{
                    $request->session()->flash('error','Wrong Password');
                    return redirect('admin')->withInput();
                }
              }else{

                $request->session()->flash('error','this email address doesnot exist in our system');
                  return redirect('admin')->withInput();
              }
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }
    public function dashboard()
    {
        //
        return view('admin.dashboard');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
   
}
