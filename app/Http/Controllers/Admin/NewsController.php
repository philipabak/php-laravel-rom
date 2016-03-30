<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;
use App\Category as CategoryModel;
use App\Membertype as MembertypeModel;
use App\Romstatus as RomstatusModel;
use App\File as FileModel;
use App\Newscategory as NewscategoryModel;
use App\Newslist as NewslistModel;


class NewsController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addNews()
    {
        $param = array();

        $memberType = MembertypeModel::where('status', 1)->get();
        $newsCategoryList = NewscategoryModel::all();

        $param['memberType'] = $memberType;
        $param['newsCategoryList'] = $newsCategoryList;
        $param['title'] = 'Add News';
        return View::make('admin.news.addNews')->with($param);
    }

    public function addNew()
    {
        $param = [];
        $check_exisitng = NewslistModel::where('title', Input::get('title'))->get();
        if(count($check_exisitng) == 0) {

            $userItem = new NewslistModel;

            $userItem->title = Input::get('title');
            $userItem->slug = Input::get('slug');
            $userItem->category = Input::get('category');
            $userItem->content = Input::get('content');
            $userItem->visible_to = Input::get('visible_to');
            $userItem->status = Input::get('status');

            if (Input::hasFile('photo')) {

                $filename = str_random(24) . "." . Input::file('photo')->getClientOriginalExtension();
                Input::file('photo')->move('assets/backend/img/news_covers/', $filename);
                $userItem->image = $filename;
            }else{
                $userItem->image = '';
            }

            $userItem->allow_comments = 0;

            $userItem->save();

            $param['message'] = "New News has been saved.";
        }else{

            $param['message'] = "Current News title is already exist.";

        }

        $memberType = MembertypeModel::where('status', 1)->get();
        $newsCategoryList = NewscategoryModel::all();

        $param['memberType'] = $memberType;
        $param['newsCategoryList'] = $newsCategoryList;
        $param['title'] = 'Add News';
        return View::make('admin.news.addNews')->with($param);

//        return Redirect::route('admin.pages.addPage');
    }

    public function delete($id)
    {
        $param = [];

        $userItem = NewslistModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current page has been deleted.']);
    }

    public function enable($id)
    {
        $param = [];

        $userItem = NewslistModel::find($id);
        $userItem->status = 1;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current News has been enabled.']);
    }

    public function disable($id)
    {
        $param = [];
        $userItem = NewslistModel::find($id);
        $userItem->status = 0;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current News has been disabled.']);
    }

    public function view($id)
    {
        $param = [];

        $viewNews = NewslistModel::find($id);
        $visibleTo = MembertypeModel::find($viewNews->visible_to);
        if($viewNews->status == 1) $status = 'Enable';
        else $status = 'Disable';
        $param['viewNews'] = $viewNews;
        $param['visibleTo'] = $visibleTo;
        $param['status'] = $status;
        $param['title'] = 'View News';
        return View::make('admin.news.viewNews')->with($param);
    }

    public function edit($id)
    {
        $param = [];

        $viewNews = NewslistModel::find($id);
        $memberType = MembertypeModel::where('status', 1)->get();
        $newsCategoryList = NewscategoryModel::all();

        $param['viewNews'] = $viewNews;
        $param['newsCategoryList'] = $newsCategoryList;
        $param['memberType'] = $memberType;
        $param['title'] = 'Edit News';

        return View::make('admin.news.editNews')->with($param);
    }

    public function update($id)
    {
        //
        $param = [];

        $userItem = NewslistModel::find($id);

        $userItem->title = Input::get('title');
        $userItem->slug = Input::get('slug');
        $userItem->category = Input::get('category');
        $userItem->content = Input::get('content');
        $userItem->visible_to = Input::get('visible_to');
        $userItem->status = Input::get('status');

        if (Input::hasFile('photo')) {

            $filename = str_random(24) . "." . Input::file('photo')->getClientOriginalExtension();
            Input::file('photo')->move('assets/backend/img/news_covers/', $filename);
            $userItem->image = $filename;
        }

        $userItem->save();

        $param['message'] = "New News has been updated.";

        $viewNews = NewslistModel::find($id);
        $visibleTo = MembertypeModel::find($viewNews->visible_to);
        if($viewNews->status == 1) $status = 'Enable';
        else $status = 'Disable';
        $param['viewNews'] = $viewNews;
        $param['visibleTo'] = $visibleTo;
        $param['status'] = $status;
        $param['title'] = 'View News';
        return View::make('admin.news.viewNews')->with($param);
    }

    public function manageNews()
    {
        //
        $param = [];
        $newsCategoryList = [];
        $memberType = [];

        $newsList = NewslistModel::all();
        $countNews = count($newsList);

        for($i=0;$i<$countNews;$i++){
            $newsCategoryList[$i] = NewscategoryModel::find($newsList[$i]->category);
            $memberType[$i] = MembertypeModel::find($newsList[$i]->visible_to);
        }

        $param['newsList'] = $newsList;
        $param['newsCategoryList'] = $newsCategoryList;
        $param['memberType'] = $memberType;

        $param['title'] = 'News';
        return View('admin.news.manageNews')->with($param);
    }

}
