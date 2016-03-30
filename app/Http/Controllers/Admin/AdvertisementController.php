<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;

class AdvertisementController extends BaseController
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

        $param['title'] = 'Advertisement';
        return View::make('admin.dashboard.dashboard')->with($param);
    }

}
