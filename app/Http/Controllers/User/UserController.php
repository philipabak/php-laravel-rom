<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html, Mail;
use App\User as UserModel;
use App\Region as RegionModel;
use App\Membertype as MembertypeModel;
use App\Membershipplan as MembershipplanModel;
use App\Category as CategoryModel;
use App\File as FileModel;

class UserController extends BaseController
{
    public function __construct()    {
    }

    public function aaa()
    {
        $param = array();

        return View::make('welcome')->with($param);
        return View::make('welcome')->with($param);
    }
    public function index()
    {
        $param = array();

        $param['title'] = 'LogIn';
        return View::make('admin.login')->with($param);
    }

    public function home()
    {
        //
        $param = [];

        $param['title'] = 'Home';
        return View('user.home')->with($param);
    }

    public function search()
    {
        //
        $param = [];
        $file_list = [];
        $slug = '';

        $param['title'] = 'Search';
        $param['fileList'] = $file_list;
        $param['keyword'] = $slug;
        return View('user.search')->with($param);
    }

    public function searchResult($slug)
    {
        //
        $param = [];

        $keyword = '%' . $slug . '%';
        $file_list = FileModel::where('search_terms', 'like', $keyword)->orwhere('slug', 'like', $keyword)->paginate(5);
        $counter = 0;
        foreach($file_list as $item){
            $categoryItem = CategoryModel::find($item->category_id);
            $item['category_slug'] = $categoryItem->slug;

            $parentItem = CategoryModel::find($categoryItem->parent_id);
            $item['parent_slug'] = $parentItem->slug;
            $file_list[$counter] = $item;
            $counter++;
        }

        $param['title'] = 'Search';
        $param['fileList'] = $file_list;
        $param['keyword'] = $slug;
        return View('user.search')->with($param);
    }

    public function signin()
    {
        //
        $param = [];

        $param['title'] = 'Sign In';
        return View('user.userLogin')->with($param);
    }

    public function login()
    {
        //
        $param = [];

        $checkExist = UserModel::where('username', Input::get('username'))->where('password', '=', md5(Input::get('password')))->where('active', 1)->where('is_admin', 1)->get();
        if(count($checkExist) > 0) {

            Session::set('is_admin', 1);
            Session::set('user_id', $checkExist[0]->id);
            Session::set('role', $checkExist[0]->role);
            Session::set('first_name', $checkExist[0]->first_name);
            Session::set('last_name', $checkExist[0]->last_name);
            Session::set('user_email', $checkExist[0]->email);
            return Redirect::route('admin.dashboard.index');

        }else{

            $param['title'] = "LogIn";
            $param['message'] = "Username or Password is incorrect.";
            return View::make('admin.login')->with($param);
        }
    }

    public function userLogin()
    {
        //
        $param = [];

        $checkExist = UserModel::where('username', Input::get('username'))->where('password', '=', md5(Input::get('password')))->where('active', 1)->get();
        if(count($checkExist) > 0) {

            if($checkExist[0]->email_verified == 0){
                $param['title'] = "LogIn";
                $param['message'] = "You have to verify with your email.";
                return View::make('user.userLogin')->with($param);
            }else{
                Session::set('user_id', $checkExist[0]->id);
                Session::set('user_type', $checkExist[0]->user_type);
                Session::set('role', $checkExist[0]->role);
                Session::set('first_name', $checkExist[0]->first_name);
                Session::set('last_name', $checkExist[0]->last_name);
                Session::set('user_email', $checkExist[0]->email);

                return Redirect::route('user.profile.dashboard');
            }

        }else{
            $param['title'] = "LogIn";
            $param['message'] = "Username or Password is incorrect.";
            return View::make('user.userLogin')->with($param);
        }
    }

    public function userLogout() {

        Session::forget('user_id');
        Session::forget('user_type');
        Session::forget('role');
        Session::forget('first_name');
        Session::forget('last_name');
        Session::forget('user_email');

        $param['title'] = "LogIn";
        return View::make('user.userLogin')->with($param);
    }


    public function forgetpassword()
    {
        //
        $param = [];


        $param['title'] = 'Users';
        return View('welcome')->with($param);
    }

    public function userForgetpassword()
    {
        //
        $param = [];

        $userItem = UserModel::where('email', Input::get('email'))->get();
        if(count($userItem) == 0){
            $param['message'] = "Please create your account.";

            $param['title'] = 'Login';
            return View::make('user.userLogin')->with($param);

        }

        $data = array();
        $data['from_name'] = 'Administrator';

        $adminItem = UserModel::where('is_admin', 1)->get();
        $data['from_usr'] = $adminItem[0]->email;
        $data['to_usr'] = Input::get('email');
        $data['title'] = 'Forget Password';
        $data['token_value'] = csrf_token();
        $data['reset_url'] = url() . '/resetPassword';

        $to_address = $data['to_usr'];
        $from_address = $data['from_usr'];

        Mail::send('user.mailForget', $data, function ($message) use ($from_address, $to_address) {
            $message->from($from_address);
            $message->to($to_address);
            $message->subject('Confirm');
        });

        $param['message'] = "The request is sent to your email, Please confirm the request.";

        $param['title'] = 'Login';
        return View::make('user.userLogin')->with($param);

    }

    public function resetPassword()
    {
        //
        $param = [];

        $email = Input::get('email');
        $param['email'] = $email;
        $param['title'] = 'Reset Password';
        return View::make('user.resetPassword')->with($param);

    }

    public function verifyEmail()
    {
        //
        $param = [];

        $email = Input::get('email');

        $userItem = UserModel::where('email', $email)->get();
        $userItem[0]->email_verified = 1;
        $userItem[0]->save();

        $param['message'] = "Your email is verified.";
        $param['title'] = 'Login';
        return View::make('user.userLogin')->with($param);

    }

    public function doResetPassword()
    {
        //
        $param = [];

        $email = Input::get('email');
        $password = Input::get('password');

        $userItem = UserModel::where('email', $email)->get();
        $userItem[0]->password = md5($password);
        $userItem[0]->save();

        $param['message'] = "Your password is changed.";

        $param['title'] = 'Login';
        return View::make('user.userLogin')->with($param);

    }

    public function createAccount()
    {
        //
        $param = [];

        $check_exisitng = UserModel::where('username', Input::get('username'))->get();
        if(count($check_exisitng) == 0) $m_username = 1;
        else $m_username = 0;
        $check_exisitng = UserModel::where('email', Input::get('email'))->get();
        if(count($check_exisitng) == 0) $m_email = 1;
        else $m_email = 0;
        if($m_username == 1 && $m_email == 1) {

            $userItem = new UserModel;
            $userItem->user_type = 4;

            $memberType = MembertypeModel::find(4);
            $userItem->role = $memberType->type;

            $userItem->points = 10;
            $userItem->first_name = '';
            $userItem->last_name = '';
            $userItem->email = Input::get('email');
            $userItem->email_verified = 0;
            $userItem->username = Input::get('username');
            $userItem->password = md5(Input::get('password'));
            $userItem->photo = '1.jpeg';
            $userItem->active = 1;

            $userItem->ip = Request::ip();
            $userItem->is_admin = 0;

            $userItem->save();

            $data = array();
            $data['from_name'] = 'Administrator';

            $adminItem = UserModel::where('is_admin', 1)->get();
            $data['from_usr'] = $adminItem[0]->email;
            $data['to_usr'] = Input::get('email');
            $data['title'] = 'Verify Email';
            $data['token_value'] = csrf_token();
            $data['reset_url'] = url() . '/verifyEmail';

            $to_address = $data['to_usr'];
            $from_address = $data['from_usr'];

            Mail::send('user.mailVerify', $data, function ($message) use ($from_address, $to_address) {
                $message->from($from_address);
                $message->to($to_address);
                $message->subject('Confirm');
            });

            $param['message'] = "The request is sent to your email, Please verify with your email.";

        }else{
            if(!$m_username) $param['message'] = "Current username is already used.";
            else $param['message'] = "Current email is already used.";
        }

        $param['title'] = 'Login';
        return View::make('user.userLogin')->with($param);
    }

    public function uploadAccountImage()
    {
        //
        $param = [];

        $userItem = UserModel::find(Session::get('user_id'));

        if (Input::hasFile('avtar')) {

            $filename = Input::get('username') . str_random(12) . '_thumb' . "." . Input::file('avtar')->getClientOriginalExtension();
            Input::file('avtar')->move('assets/backend/img/avatars/', $filename);
            $userItem->photo = $filename;
        }
        $userItem->save();

        return Redirect::route('user.profile.dashboard');
    }

}
