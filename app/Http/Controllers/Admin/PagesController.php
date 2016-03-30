<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;
use App\Category as CategoryModel;
use App\Membertype as MembertypeModel;
use App\Romstatus as RomstatusModel;
use App\File as FileModel;
use App\Cmspage as CmspageModel;

class PagesController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addPage()
    {
        $param = array();

        $memberType = MembertypeModel::where('status', 1)->get();

        $param['memberType'] = $memberType;
        $param['title'] = 'Add Page';
        return View::make('admin.pages.addPage')->with($param);
    }

    public function view($id)
    {
        $param = [];

        $viewPage = CmspageModel::find($id);
        $visibleTo = MembertypeModel::find($viewPage->visible_to);

        $param['viewPage'] = $viewPage;
        $param['visibleTo'] = $visibleTo;
        $param['title'] = 'View Page';
        return View::make('admin.pages.viewPage')->with($param);
    }

    public function edit($id)
    {
        $param = [];

        $viewPage = CmspageModel::find($id);
        $memberType = MembertypeModel::where('status', 1)->get();

        $param['memberType'] = $memberType;

        $param['viewPage'] = $viewPage;
        $param['title'] = 'Edit Page';
        return View::make('admin.pages.editPage')->with($param);
    }

    public function enable($id)
    {
        $param = [];

        $userItem = CmspageModel::find($id);
        $userItem->status = 1;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current page has been enabled.']);
    }

    public function disable($id)
    {
        $param = [];
        $userItem = CmspageModel::find($id);
        $userItem->status = 0;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current page has been disabled.']);
    }

    public function delete($id)
    {
        //
        $param = [];

        $userItem = CmspageModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current page has been deleted.']);
    }

    public function update($id)
    {
        //
        $param = [];

        $userItem = CmspageModel::find($id);

        $userItem->title = Input::get('title');
        $userItem->slug = Input::get('slug');
        $userItem->content = Input::get('content');
        $userItem->visible_to = Input::get('visible_to');
        $userItem->status = Input::get('status');
        $userItem->meta_title = Input::get('meta_title');
        $userItem->keywords = Input::get('keywords');
        $userItem->meta_description = Input::get('meta_description');
        if(Input::get('p_area')) $userItem->p_area = Input::get('p_area');
        else $userItem->p_area = '';

        $max_sort = DB::table('cms_pages')->max('p_sort');
        $userItem->p_sort = $max_sort + 1;

        $userItem->save();

        $param['message'] = "Current CMS page has been updated.";

        $viewPage = CmspageModel::find($id);
        $visibleTo = MembertypeModel::find($viewPage->visible_to);

        $param['viewPage'] = $viewPage;
        $param['visibleTo'] = $visibleTo;
        $param['title'] = 'View Page';
        return View::make('admin.pages.viewPage')->with($param);
    }

    public function addNew()
    {
        $param = [];
        $check_exisitng = CmspageModel::where('title', Input::get('title'))->get();
        if(count($check_exisitng) == 0) {

            $userItem = new CmspageModel;

            $userItem->title = Input::get('title');
            $userItem->slug = Input::get('slug');
            $userItem->content = Input::get('content');
            $userItem->visible_to = Input::get('visible_to');
            $userItem->status = Input::get('status');
            $userItem->meta_title = Input::get('meta_title');
            $userItem->keywords = Input::get('keywords');
            $userItem->meta_description = Input::get('meta_description');
            if(Input::get('p_area')) $userItem->p_area = Input::get('p_area');
            else $userItem->p_area = '';

            $max_sort = DB::table('cms_pages')->max('p_sort');
            $userItem->p_sort = $max_sort + 1;

            $userItem->save();

            $param['message'] = "New CMS page has been saved.";
        }else{

            $param['message'] = "Current page title is already exist.";

        }

        $memberType = MembertypeModel::where('status', 1)->get();

        $param['memberType'] = $memberType;
        $param['title'] = 'Add Page';
        return View::make('admin.pages.addPage')->with($param);

//        return Redirect::route('admin.pages.addPage');
    }

    public function managePage()
    {
        //
        $param = [];

        $pageList = CmspageModel::all();

        $param['pageList'] = $pageList;
        $param['title'] = 'Pages';
        return View::make('admin.pages.managePage')->with($param);
    }

}
