<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;
use App\Region as RegionModel;
use App\Membertype as MembertypeModel;
use App\Membershipplan as MembershipplanModel;

class MembershipsController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addMembership()
    {
        $param = array();

        $param['title'] = 'Add Membership';
        return View::make('admin.memberships.addMembership')->with($param);
    }

    public function addNew()
    {
        $param = [];
        $check_exisitng = MembershipplanModel::where('PlanType', Input::get('PlanType'))->get();
        if(count($check_exisitng) == 0) {

            $userItem = new MembershipplanModel;

            $userItem->PlanType = Input::get('PlanType');
            $userItem->Price = Input::get('Price');
            $userItem->PlanDuration = Input::get('PlanDuration');
            $userItem->ConnectionsUpTo = Input::get('ConnectionsUpTo');
            $userItem->DownloadingLimit = Input::get('DownloadingLimit');
            if(Input::get('DownloadingLimit')) $userItem->DownloadingType = Input::get('DownloadingType');
            else $userItem->DownloadingType = '';

            $userItem->save();

            $param['message'] = "New Membership Type has been saved.";
        }else{
            $param['message'] = "Current Membership Type is already saved.";
        }

        $param['title'] = 'Add Membership';
        return View::make('admin.memberships.addMembership')->with($param);

    }

    public function manageMembership()
    {
        //
        $param = [];
        $membershipType = MembershipplanModel::all();

        $param['membershipType'] = $membershipType;

        $param['title'] = 'Memberships';
        return View('admin.memberships.manageMembership')->with($param);
    }

    public function view($id)
    {
        //
        $param = [];

        $userItem = MembershipplanModel::find($id);

        $param['userItem'] = $userItem;
        $param['title'] = 'View Membership';
        return View::make('admin.memberships.viewMembership')->with($param);
    }

    public function edit($id)
    {
        //
        $param = [];

        $userItem = MembershipplanModel::find($id);

        $param['userItem'] = $userItem;
        $param['title'] = 'Edit Membership';
        return View::make('admin.memberships.editMembership')->with($param);
    }

    public function update($id)
    {
        //
        $param = [];

        $userItem = MembershipplanModel::find($id);

        $userItem->PlanType = Input::get('PlanType');
        $userItem->Price = Input::get('Price');
        $userItem->PlanDuration = Input::get('PlanDuration');
        $userItem->ConnectionsUpTo = Input::get('ConnectionsUpTo');
        $userItem->DownloadingLimit = Input::get('DownloadingLimit');
        if(Input::get('DownloadingLimit')) $userItem->DownloadingType = Input::get('DownloadingType');
        else $userItem->DownloadingType = '';

        $userItem->save();

        $userItem = MembershipplanModel::find($id);

        $param['userItem'] = $userItem;
        $param['message'] = "Current Membership Type has been updated.";
        $param['title'] = 'View Membership';
        return View::make('admin.memberships.viewMembership')->with($param);
    }

    public function delete($id)
    {
        //
        $param = [];

        $userItem = MembershipplanModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current membership type has been deleted.']);
    }

}
