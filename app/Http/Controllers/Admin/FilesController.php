<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html, File;
use App\User as UserModel;
use App\Category as CategoryModel;
use App\Membertype as MembertypeModel;
use App\Romstatus as RomstatusModel;
use App\File as FileModel;
use App\Newscategory as NewscategoryModel;
use App\Region as RegionModel;

class FilesController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addFile()
    {
        $param = array();
        $categoryList = [];
        $categoryParent = CategoryModel::where('parent_id', '')->orwhere('parent_id', null)->get();
        $countParent = count($categoryParent);

        $k = 0;
        for($i=0;$i<$countParent;$i++){
            $categoryList[$k] = $categoryParent[$i];
            $categoryItem = CategoryModel::where('parent_id', $categoryParent[$i]->id)->get();
            $countItem = count($categoryItem);
            if($countItem > 0) {
                $k++;
                for ($j = 0; $j < $countItem; $j++) {
                    $categoryList[$k] = $categoryItem[$j];
                    $k++;
                }
            }else{
                $k++;
            }
        }

        $regionList = RegionModel::all();

        $memberType = MembertypeModel::where('status', 1)->get();
        $romStatus = RomstatusModel::all();

        $param['regionList'] = $regionList;
        $param['categoryList'] = $categoryList;
        $param['memberType'] = $memberType;
        $param['romStatus'] = $romStatus;
        $param['title'] = 'Add File';
        return View::make('admin.files.addFile')->with($param);
    }

    public function addNew()
    {
        $param = [];
        $check_exisitng = FileModel::where('title', Input::get('title'))->get();
        if(count($check_exisitng) == 0) {

            $userItem = new FileModel;

            $userItem->title = Input::get('title');
            $userItem->slug = Input::get('slug');
            $userItem->category_id = Input::get('parent_id');
            $userItem->author = Input::get('author');
            $userItem->author_email = Input::get('author_email');
            $userItem->author_website = Input::get('author_website');
            $userItem->description = Input::get('description');
            $userItem->search_terms = Input::get('search_terms');
            $userItem->allow_comment = Input::get('allow_comment');
            $userItem->download_visible_to = Input::get('download_visible_to');
            $userItem->download_by = Input::get('download_by');
            $userItem->region = Input::get('region');
            $userItem->release = Input::get('release');
            $userItem->version = Input::get('version');
            $userItem->language = Input::get('language');
            $userItem->status = Input::get('status');


            if (Input::hasFile('file')) {

//                $filename = Input::get('title') . "." . Input::file('file')->getClientOriginalExtension();
                $filename = Input::file('file')->getClientOriginalName();
// get path
                $i = -1;
                $path = '';
                $id =Input::get('parent_id');
                while($i < 0){
                    $row = CategoryModel::find($id);
                    $path = $row->name . $path;
                    if($row->parent_id){
                        $path = '/' . $path;
                        $id = $row->parent_id;
                    }else{
                        $i = 1;
                    }
                }
                $path = 'uploads/' . $path . '/';
                Input::file('file')->move($path, $filename);
                $userItem->file = $filename;
                $userItem->file_size = File::size($path . $filename);
                $userItem->file_path = $path;
            }else{
                $userItem->file = '';
            }

            if (Input::hasFile('image')) {

                $filename = str_random(12) . '_thumb' . "." . Input::file('image')->getClientOriginalExtension();
                Input::file('image')->move('assets/backend/img/rom_images/thumb/', $filename);
                $userItem->image = $filename;
            }else{
                $userItem->image = 'empty.jpg';
            }

            if(Input::get('url')) $userItem->url = Input::get('url');
            else $userItem->url = '';

            $userItem->user_id = Session::get('user_id');

            $userItem->save();

            $param['message'] = "New file has been stored successfully!";
        }else{

            $param = array();
            $categoryList = [];
            $categoryParent = CategoryModel::where('parent_id', '')->orwhere('parent_id', null)->get();
            $countParent = count($categoryParent);

            $k = 0;
            for($i=0;$i<$countParent;$i++){
                $categoryList[$k] = $categoryParent[$i];
                $categoryItem = CategoryModel::where('parent_id', $categoryParent[$i]->id)->get();
                $countItem = count($categoryItem);
                if($countItem > 0) {
                    $k++;
                    for ($j = 0; $j < $countItem; $j++) {
                        $categoryList[$k] = $categoryItem[$j];
                        $k++;
                    }
                }else{
                    $k++;
                }
            }

            $memberType = MembertypeModel::where('status', 1)->get();
            $romStatus = RomstatusModel::all();
            $regionList = RegionModel::all();

            $param['regionList'] = $regionList;
            $param['categoryList'] = $categoryList;
            $param['memberType'] = $memberType;
            $param['romStatus'] = $romStatus;
            $param['message'] = "Current title is already exist.";
            $param['title'] = 'Add File';
            return View::make('admin.files.addFile')->with($param);
        }

        $categoryList = [];
        $categoryParent = CategoryModel::where('parent_id', '')->orwhere('parent_id', null)->get();
        $countParent = count($categoryParent);

        $k = 0;
        for($i=0;$i<$countParent;$i++){
            $categoryList[$k] = $categoryParent[$i];
            $categoryItem = CategoryModel::where('parent_id', $categoryParent[$i]->id)->get();
            $countItem = count($categoryItem);
            if($countItem > 0) {
                $k++;
                for ($j = 0; $j < $countItem; $j++) {
                    $categoryList[$k] = $categoryItem[$j];
                    $k++;
                }
            }else{
                $k++;
            }
        }

        $memberType = MembertypeModel::where('status', 1)->get();
        $romStatus = RomstatusModel::all();
        $regionList = RegionModel::all();

        $param['regionList'] = $regionList;
        $param['categoryList'] = $categoryList;
        $param['memberType'] = $memberType;
        $param['romStatus'] = $romStatus;
        $param['message'] = 'New user data has been saved.';
        $param['title'] = 'Add File';
        return View::make('admin.files.addFile')->with($param);

//        return Redirect::route('admin.files.manageFile');
    }

    public function delete($id)
    {
        $param = [];

        $userItem = FileModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current file has been deleted.']);
    }

    public function view($id)
    {
        $param = array();

        $romview = FileModel::find($id);

        $categoryName = CategoryModel::find($romview->category_id);
        $downloadBy = MembertypeModel::find($romview->download_by);
        $downloadVisible = MembertypeModel::find($romview->download_visible_to);
        $region = RegionModel::find($romview->region);
        $status = RomstatusModel::find($romview->status);

        $param['romview'] = $romview;
        $param['categoryName'] = $categoryName;
        $param['downloadBy'] = $downloadBy;
        $param['downloadVisible'] = $downloadVisible;
        $param['region'] = $region;
        $param['status'] = $status;

        $param['title'] = 'View File';
        return View::make('admin.files.viewFile')->with($param);
    }

    public function edit($id)
    {
        $param = array();
        $categoryList = [];
        $categoryParent = CategoryModel::where('parent_id', '')->orwhere('parent_id', null)->get();
        $countParent = count($categoryParent);

        $k = 0;
        for($i=0;$i<$countParent;$i++){
            $categoryList[$k] = $categoryParent[$i];
            $categoryItem = CategoryModel::where('parent_id', $categoryParent[$i]->id)->get();
            $countItem = count($categoryItem);
            if($countItem > 0) {
                $k++;
                for ($j = 0; $j < $countItem; $j++) {
                    $categoryList[$k] = $categoryItem[$j];
                    $k++;
                }
            }else{
                $k++;
            }
        }

        $regionList = RegionModel::all();

        $memberType = MembertypeModel::where('status', 1)->get();
        $romStatus = RomstatusModel::all();
        $romview = FileModel::find($id);

        $param['regionList'] = $regionList;
        $param['categoryList'] = $categoryList;
        $param['memberType'] = $memberType;
        $param['romStatus'] = $romStatus;
        $param['romview'] = $romview;
        $param['title'] = 'Edit File';
        return View::make('admin.files.editFile')->with($param);
    }

    public function update($id)
    {
        $param = [];

        $userItem = FileModel::find($id);

        $userItem->title = Input::get('title');
        $userItem->slug = Input::get('slug');
        $userItem->author = Input::get('author');
        $userItem->author_email = Input::get('author_email');
        $userItem->author_website = Input::get('author_website');
        $userItem->description = Input::get('description');
        $userItem->search_terms = Input::get('search_terms');
        $userItem->allow_comment = Input::get('allow_comment');
        $userItem->download_visible_to = Input::get('download_visible_to');
        $userItem->download_by = Input::get('download_by');
        $userItem->region = Input::get('region');
        $userItem->language = Input::get('language');
        $userItem->release = Input::get('release');
        $userItem->version = Input::get('version');
        $userItem->status = Input::get('status');

        if (Input::hasFile('image')) {

            $filename = str_random(12) . '_thumb' . "." . Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move('assets/backend/img/rom_images/thumb/', $filename);
            $userItem->image = $filename;
        }

        if(Input::get('url')) $userItem->url = Input::get('url');
        else $userItem->url = '';

        $userItem->user_id = Session::get('user_id');

        $userItem->save();

        $param['message'] = "Current file has been updated";

        $romview = FileModel::find($id);

        $categoryName = CategoryModel::find($romview->category_id);
        $downloadBy = MembertypeModel::find($romview->download_by);
        $downloadVisible = MembertypeModel::find($romview->download_visible_to);
        $region = RegionModel::find($romview->region);
        $status = RomstatusModel::find($romview->status);

        $param['romview'] = $romview;
        $param['categoryName'] = $categoryName;
        $param['downloadBy'] = $downloadBy;
        $param['downloadVisible'] = $downloadVisible;
        $param['region'] = $region;
        $param['status'] = $status;

        $param['title'] = 'View File';
        return View::make('admin.files.viewFile')->with($param);

//        return Redirect::route('admin.files.manageFile');
    }

    public function manageFile()
    {
        //
        $param = [];
        $categoryList = [];
        $memberType_to = [];
        $memberType_by = [];
        $romStatus = [];

        $romList = FileModel::all();
        $countRom = count($romList);

        for($i=0;$i<$countRom;$i++){
            $categoryList[$i] = CategoryModel::find($romList[$i]->category_id);
            $memberType_to[$i] = MembertypeModel::find($romList[$i]->download_visible_to);
            $memberType_by[$i] = MembertypeModel::find($romList[$i]->download_by);
            $romStatus[$i] = RomstatusModel::find($romList[$i]->status);
        }

        $param['romList'] = $romList;
        $param['categoryList'] = $categoryList;
        $param['memberType_to'] = $memberType_to;
        $param['memberType_by'] = $memberType_by;
        $param['romStatus'] = $romStatus;

        $param['title'] = 'Files';
        return View('admin.files.manageFile')->with($param);
    }

}
