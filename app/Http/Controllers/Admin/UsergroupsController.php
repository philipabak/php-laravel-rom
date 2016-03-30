<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;
use App\Region as RegionModel;
use App\Membertype as MembertypeModel;
use App\Membershipplan as MembershipplanModel;

class UsergroupsController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addUsergroup()
    {
        $param = array();

        $param['title'] = 'Add Usergroup';
        return View::make('admin.usergroups.addUsergroup')->with($param);
    }

    public function addNew()
    {
        $param = [];
        $check_exisitng = MembertypeModel::where('type', Input::get('type'))->get();
        if(count($check_exisitng) == 0) {

            $userItem = new MembertypeModel;

            $userItem->type = Input::get('type');
            $userItem->status = Input::get('status');

            $userItem->save();

            $param['message'] = "New Usergroup has been added.";
        }else{
            $param['message'] = "Current Usergroup is already existed.";
        }

        $param['title'] = 'Add Usergroup';
        return View::make('admin.usergroups.addUsergroup')->with($param);

    }

    public function manageUsergroup()
    {
        //
        $param = [];
        $memberType = MembertypeModel::all();

        $param['memberType'] = $memberType;

        $param['title'] = 'Usergroup';
        return View('admin.usergroups.manageUsergroup')->with($param);
    }

    public function view($id)
    {
        //
        $param = [];
        $userItem = MembertypeModel::find($id);
        $param['userItem'] = $userItem;
        $param['title'] = 'View Usergroup';
        return View::make('admin.usergroups.viewUsergroup')->with($param);
    }

    public function edit($id)
    {
        //
        $param = [];

        $userItem = MembertypeModel::find($id);

        $param['userItem'] = $userItem;
        $param['title'] = 'Edit Usergroup';
        return View::make('admin.usergroups.editUsergroup')->with($param);
    }

    public function update($id)
    {
        //
        $param = [];

        $userItem = MembertypeModel::find($id);

        $userItem->type = Input::get('type');
        $userItem->status = Input::get('status');

        $userItem->save();

        $userItem = MembertypeModel::find($id);

        $param['userItem'] = $userItem;
        $param['message'] = "Current Usergroup has been updated.";
        $param['title'] = 'View Usergroup';
        return View::make('admin.usergroups.viewUsergroup')->with($param);
    }

    public function delete($id)
    {
        //
        $param = [];

        $userItem = MembertypeModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current usergroup has been deleted.']);
    }

    public function enable($id)
    {
        //
        $param = [];

        $userItem = MembertypeModel::find($id);
        $userItem->status = 1;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current usergroup has been enabled.']);
    }

    public function disable($id)
    {
        //
        $param = [];

        $userItem = MembertypeModel::find($id);
        $userItem->status = 0;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current usergroup has been disabled.']);
    }

}
