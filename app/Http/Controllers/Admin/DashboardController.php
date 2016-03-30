<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;

class DashboardController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function index()
    {
        $param = array();
        $param['title'] = 'Dashboard';
        return View::make('admin.dashboard.dashboard')->with($param);
    }

    public function home()
    {
        //
        $param = [];

        $param['title'] = 'Users';
        return View('welcome')->with($param);
    }

    public function login()
    {
        //
        $param = [];

        $checkExist = UserModel::where('username', Input::get('username'))->where('password', '=', md5(Input::get('password')))->where('active', 1)->get();
        if(count($checkExist) > 0) {

            if($checkExist[0]->is_admin == 1){
                Session::set('is_admin', 1);
            }else{
                Session::set('is_admin', 0);
            }

            Session::set('user_id', $checkExist[0]->id);
            Session::set('role', $checkExist[0]->role);
            Session::set('first_name', $checkExist[0]->first_name);
            Session::set('last_name', $checkExist[0]->last_name);
            Session::set('user_email', $checkExist[0]->email);

            Redirect::route('admin.dashboard.index');

        }else{

            $param['title'] = "LogIn";
            $param['message'] = "Username or Password is incorrect.";
            return View::make('admin.login')->with($param);
        }
    }

    public function logout() {

        Session::forget('user_id');
        Session::forget('role');
        Session::forget('first_name');
        Session::forget('last_name');
        Session::forget('user_email');
        Session::forget('is_admin');

        $param['title'] = "LogIn";
        $param['message'] = "Good-Bye";
        return View::make('admin.login')->with($param);
    }

    public function forgetpassword()
    {
        //
        $param = [];

        $param['title'] = 'Users';
        return View('welcome')->with($param);
    }

    public function viewProfile()
    {
        //
        $param = [];

        $param['title'] = 'Users';
        return View('welcome')->with($param);
    }

    public function changePassword()
    {
        //
        $param = [];

        $param['title'] = 'Users';
        return View('welcome')->with($param);
    }

    public function screenLock()
    {
        //
        $param = [];

        $param['title'] = 'Users';
        return View('welcome')->with($param);
    }

}
