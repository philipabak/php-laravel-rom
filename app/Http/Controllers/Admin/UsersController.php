<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;
use App\Region as RegionModel;
use App\Membertype as MembertypeModel;
use App\Membershipplan as MembershipplanModel;

class UsersController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addUser()
    {
        $param = array();

        $countryList = RegionModel::all();
        $memberType = MembertypeModel::where('status', 1)->get();
        $membershipType = MembershipplanModel::all();

        $param['membershipType'] = $membershipType;
        $param['memberType'] = $memberType;
        $param['countryList'] = $countryList;
        $param['title'] = 'Add User';
        return View::make('admin.users.addUser')->with($param);
    }

    public function addNew()
    {
        $param = [];
        $check_exisitng = UserModel::where('username', Input::get('username'))->get();
        if(count($check_exisitng) == 0) $m_username = 1;
        else $m_username = 0;
        $check_exisitng = UserModel::where('email', Input::get('email'))->get();
        if(count($check_exisitng) == 0) $m_email = 1;
        else $m_email = 0;
        if($m_username == 1 && $m_email == 1) {

            $userItem = new UserModel;
            $userItem->user_type = Input::get('role');

            $memberType = MembertypeModel::find(Input::get('role'));
            if(Input::get('role') == 0) $userItem->role = 'Admin';
            else $userItem->role = $memberType->type;

            $userItem->membership_type = Input::get('membership_role');

            $membershipType = MembershipplanModel::find(Input::get('membership_role'));
            if(Input::get('role') == 7) $userItem->membership_role = $membershipType->PlanType;
            $userItem->points = Input::get('points');
            $nameArray = explode(' ', Input::get('name'));
            $userItem->first_name = $nameArray[0];
            if(count($nameArray) > 1) $userItem->last_name = $nameArray[1];
            else $userItem->last_name = '';
            $userItem->email = Input::get('email');
            $userItem->username = Input::get('username');
            $userItem->password = md5(Input::get('password'));
            $userItem->addres = Input::get('addres');
            $userItem->mobile = Input::get('mobile');
            $userItem->phone = Input::get('phone');
            $userItem->gender = Input::get('gender');
            $userItem->DOB = Input::get('DOB');
            $userItem->nationality = Input::get('nationality');
            $userItem->country = Input::get('country');
            $userItem->zip = Input::get('zip');

            if (Input::hasFile('avtar')) {

                $filename = Input::get('username') . str_random(12) . '_thumb' . "." . Input::file('avtar')->getClientOriginalExtension();
                Input::file('avtar')->move('assets/backend/img/avatars/', $filename);
                $userItem->photo = $filename;
            }else if(Input::get('avtar1')){
                $userItem->photo = Input::get('avtar1');
            }else{
                $userItem->photo = '1.jpeg';
            }

            $userItem->active = 1;

            $userItem->ip = Request::ip();
            if(Input::get('role') == 0) $userItem->is_admin = 1;
            else $userItem->is_admin = 0;

            $userItem->save();

            $param['message'] = "New User has been registered.";
        }else{
            if(!$m_username) $param['message'] = "Current username is already used.";
            else $param['message'] = "Current email is already used.";
        }

        $countryList = RegionModel::all();
        $memberType = MembertypeModel::where('status', 1)->get();
        $membershipType = MembershipplanModel::all();

        $param['membershipType'] = $membershipType;
        $param['memberType'] = $memberType;
        $param['countryList'] = $countryList;
        $param['title'] = 'Add User';
        return View::make('admin.users.addUser')->with($param);

//        return Redirect::route('admin.users.manageUser');
    }

    public function manageUser()
    {
        //
        $param = [];
        $userList = UserModel::orderBy('is_admin', 'desc')->get();

        $param['userList'] = $userList;

        $param['title'] = 'Users';
        return View('admin.users.manageUser')->with($param);
    }

    public function view($id)
    {
        //
        $param = [];

        $userItem = UserModel::find($id);
//        $countryName = RegionModel::find($userItem->country);

//        $param['countryName'] = $countryName;
        $param['userItem'] = $userItem;
        $param['title'] = 'View User';
        return View::make('admin.users.viewUser')->with($param);
    }

    public function edit($id)
    {
        //
        $param = [];

        $userItem = UserModel::find($id);
        $countryList = RegionModel::all();
        $memberType = MembertypeModel::where('status', 1)->get();
        $membershipType = MembershipplanModel::all();

        $param['membershipType'] = $membershipType;
        $param['memberType'] = $memberType;
        $param['countryList'] = $countryList;
        $param['userItem'] = $userItem;
        $param['title'] = 'Edit User';
        return View::make('admin.users.editUser')->with($param);
    }

    public function update($id)
    {
        //
        $param = [];

        $userItem = UserModel::find($id);

        $userItem->user_type = Input::get('role');
        $memberType = MembertypeModel::find(Input::get('role'));
        if(Input::get('role') == 0) $userItem->role = 'Admin';
        else $userItem->role = $memberType->type;

        if(Input::get('role') == 7) {
            $userItem->membership_type = Input::get('membership_role');
            $membershipType = MembershipplanModel::find(Input::get('membership_role'));
            $userItem->membership_role = $membershipType->PlanType;
        }else{
            $userItem->membership_type = null;
            $userItem->membership_role = null;
        }

        if(Input::get('role') == 4) {
            $userItem->points = Input::get('points');
        }else{
            $userItem->points = 0;
        }

        $nameArray = explode(' ', Input::get('name'));
        $userItem->first_name = $nameArray[0];
        if(count($nameArray) > 1) $userItem->last_name = $nameArray[1];
        else $userItem->last_name = '';
        $userItem->email = Input::get('email');
        if(Input::get('password')) $userItem->password = md5(Input::get('password'));
        $userItem->addres = Input::get('addres');
        $userItem->mobile = Input::get('mobile');
        $userItem->phone = Input::get('phone');
        $userItem->gender = Input::get('gender');
        $userItem->DOB = Input::get('DOB');
        $userItem->nationality = Input::get('nationality');
        $userItem->country = Input::get('country');
        $userItem->zip = Input::get('zip');

        if (Input::hasFile('avtar')) {

            $filename = Input::get('username') . str_random(12) . '_thumb' . "." . Input::file('avtar')->getClientOriginalExtension();
            Input::file('avtar')->move('assets/backend/img/avatars/', $filename);
            $userItem->photo = $filename;
        }else if(Input::get('avtar1')){
            $userItem->photo = Input::get('avtar1');
        }

        $userItem->active = 1;

        $userItem->ip = Request::ip();

        $userItem->save();

        $userItem = UserModel::find($id);
        $countryName = RegionModel::find($userItem->country);

        $param['countryName'] = $countryName;
        $param['userItem'] = $userItem;
        $param['title'] = 'View User';
        $param['message'] = 'Current User data has been updated.';
        return View::make('admin.users.viewUser')->with($param);

//        return Redirect::route('admin.users.manageUser');
    }

    public function enable($id)
    {
        //
        $param = [];

        $userItem = UserModel::find($id);
        $userItem->active = 1;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current user has been enabled.']);
    }

    public function disable($id)
    {
        //
        $param = [];
        $userItem = UserModel::find($id);
        $userItem->active = 0;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current user has been disabled.']);
    }

    public function delete($id)
    {
        //
        $param = [];

        $userItem = UserModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current user has been deleted.']);
    }

}
