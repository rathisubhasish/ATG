<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Session;
use Crypt;
use App\Http\Controllers\Auth;

class ManageController extends Controller
{
    function index()
    {
        return "Our Project";
    }

    function registerUser(Request $req){

        $validateData = $req->validate([
            'name'  => 'required|regex:/^[a-z A-Z]+$/u',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $result = DB::table('entry')
        ->where('email',$req->input('email'))
        ->get();

        $res = json_decode($result,true);
        
        if(sizeof($res)==0){
            $data = $req->input();
            $entry = new User;
            $entry->name = $data['name'];
            $entry->email = $data['email'];
            $encrypt_passwd = crypt::encrypt($data['password']);
            $entry->password = $encrypt_passwd;
            $entry->save();
            
            $req->session()->flash('register_status','Registered Successfully');
            return redirect('register');
        }
        else{
            $req->session()->flash('register_status','email already exists');
            return redirect('register');
        }
    }


    function login(Request $req){
        $validatedData = $req->validate([
        'email' => 'required|email',
        'password' => 'required'
        ]);
        
        $result = DB::table('entry')
        ->where('email',$req->input('email'))
        ->get();
        
        $res = json_decode($result,true);
        // print_r($res);
        
        if(sizeof($res)==0){
        $req->session()->flash('error','Email Id does not exist. Please register yourself first');
        echo "Email Id Does not Exist.";
        return redirect('login');
        }
        else{
        echo "Hello";
        $encrypted_password = $result[0]->password;
        $decrypted_password = crypt::decrypt($encrypted_password);
        }
        if($decrypted_password==$req->input('password')){
        echo "You are logged in Successfully";
        $req->session()->put('user',$result[0]->name);
        return redirect('/');
        }
        else{
        $req->session()->flash('error','Password Incorrect!!!');
        echo "Email Id Does not Exist.";
        return redirect('login');
        }
    }

    public function logout(Request $request) {
        Session::flush();
        return redirect('login');
    }
}
