<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function view()
    {
        $data['title'] = 'User Form';
        $data['userData']  = DB::table("users")->get();
        return view('dashboard', $data);
    }

    public function add(Request $postData){

        $first_name = $postData->post('firstname');
        $last_name = $postData->post('lastname');
        $email = $postData->post('email');
        $gender = $postData->post('gender');
        $password = $postData->post('password');
        $status = $postData->post('status');

        $insertData = array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>$password,
            'created_at'=>now()
        );
        $insertData = DB::table('users')->insertOrIgnore($insertData);
        return redirect()->route('userslist');
    }

    public function viewuser(string $userId){
        if(!empty($userId) && $userId !=0){
            $data['title'] = "View User";
            $data['singleUserData'] = DB::table('users')->where('id','=',$userId)->first();
            // echo '<pre>';print_r($data['singleUserData']);die;
            //return view('userview',$data);
            return view('dashboard', $data);
        }else{
            return redirect()->route('userslist');
        }
    }

    public function deleteuser(string $userId){
        if(!empty($userId) && $userId !=0){
            $isDelete = DB::table("users")->where('id','=',$userId)->delete();
        }
        return redirect()->route('userslist'); 
    }
}
