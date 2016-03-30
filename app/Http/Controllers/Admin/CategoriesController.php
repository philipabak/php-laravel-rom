<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html;
use App\User as UserModel;
use App\Category as CategoryModel;
use App\Membertype as MembertypeModel;
use App\Romstatus as RomstatusModel;
use App\File as FileModel;

class CategoriesController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function addCategory()
    {
        $param = array();

        $categoryList = [];
        $categoryParent = CategoryModel::where('parent_id', '')->orwhere('parent_id', null)->get();
        $countParent = count($categoryParent);

        $k = 0;
        for($i=0;$i<$countParent;$i++){
            $categoryList[$k] = $categoryParent[$i];
            $categoryItem = CategoryModel::where('parent_id', $categoryParent[$i]->id)->get();
//            $countItem = count($categoryItem);
            $countItem = 0;
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


        $param['categoryList'] = $categoryList;
        $param['title'] = 'Add Category';
        return View::make('admin.categories.addCategory')->with($param);
    }

    public function addNew()
    {
        //
        $param = [];
        $check_exisitng = CategoryModel::where('name', Input::get('name'))->get();
        if(count($check_exisitng) == 0) {

            $userItem = new CategoryModel;

            $userItem->name = Input::get('name');
            $userItem->slug = Input::get('slug');
            $userItem->parent_id = Input::get('parent_id');

            if (Input::hasFile('photo')) {

                $filename = str_random(12) . "." . Input::file('photo')->getClientOriginalExtension();
                Input::file('photo')->move('assets/backend/img/icon/thumb_icon/', $filename);
                $userItem->icon = $filename;
            }else{
                $userItem->icon = '';
            }

            $userItem->status = 0;

            $userItem->save();

            $param['message'] = "New category has been saved.";
        }else{
            $param['message'] = "Current category has already exist.";

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

        $param['categoryList'] = $categoryList;
        $param['title'] = 'Add Category';
        return View::make('admin.categories.addCategory')->with($param);

//        return Redirect::route('admin.files.manageFile');
    }

    public function view($id)
    {
        //
        $param = [];

        $viewCategory = CategoryModel::find($id);
        $parentCategory = CategoryModel::find($viewCategory->parent_id);
        $param['viewCategory'] = $viewCategory;
        $param['parentCategory'] = $parentCategory;
        $param['title'] = 'View Category';

        return View::make('admin.categories.viewCategory')->with($param);
    }

    public function edit($id)
    {
        //
        $param = [];

        $viewCategory = CategoryModel::find($id);

        $categoryList = [];
        $categoryParent = CategoryModel::where('parent_id', '')->orwhere('parent_id', null)->get();
        $countParent = count($categoryParent);

        $k = 0;
        for($i=0;$i<$countParent;$i++){
            $categoryList[$k] = $categoryParent[$i];
            $categoryItem = CategoryModel::where('parent_id', $categoryParent[$i]->id)->get();
//            $countItem = count($categoryItem);
            $countItem = 0;
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

        $param['categoryList'] = $categoryList;

        $param['viewCategory'] = $viewCategory;
        $param['title'] = 'Edit Category';

        return View::make('admin.categories.editCategory')->with($param);
    }

    public function update($id)
    {
        //
        $param = [];

        $userItem = CategoryModel::find($id);

        $userItem->name = Input::get('name');
        $userItem->slug = Input::get('slug');
        $userItem->parent_id = Input::get('parent_id');

        if (Input::hasFile('photo')) {

            $filename = str_random(12) . "." . Input::file('photo')->getClientOriginalExtension();
            Input::file('photo')->move('assets/backend/img/icon/thumb_icon/', $filename);
            $userItem->icon = $filename;
        }

        $userItem->save();

        $param['message'] = "Current category has been updated.";

        $viewCategory = CategoryModel::find($id);
        if($viewCategory->parent_id == 0 || $viewCategory->parent_id == null || $viewCategory->parent_id == '') $parentCategory = [];
        else $parentCategory = CategoryModel::find($viewCategory->parent_id);
        $param['viewCategory'] = $viewCategory;
        $param['parentCategory'] = $parentCategory;
        $param['title'] = 'View Category';

        return View::make('admin.categories.viewCategory')->with($param);
    }

    public function enable($id)
    {
        //
        $param = [];

        $userItem = CategoryModel::find($id);
        $userItem->status = 1;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current category has been enabled.']);
    }

    public function disable($id)
    {
        //
        $param = [];
        $userItem = CategoryModel::find($id);
        $userItem->status = 0;
        $userItem->save();

        return Response::json(['result' => 'success', 'message' => 'Current category has been disabled.']);
    }

    public function delete($id)
    {
        //
        $param = [];

        $userItem = CategoryModel::find($id);
        $userItem->delete();

        return Response::json(['result' => 'success', 'message' => 'Current category has been deleted.']);
    }

    public function manageCategory()
    {
        //
        $param = [];

        $categoryList = CategoryModel::all();
        $countCategory = count($categoryList);

        for($i=0;$i<$countCategory;$i++){
            if($categoryList[$i]->parent_id){
                $categoryParent = CategoryModel::where('id', $categoryList[$i]->parent_id)->get();
                $categoryList[$i]->parent_name = $categoryParent[0]->name;
            }
        }

        $param['categoryList'] = $categoryList;

        $param['title'] = 'Categories';
        return View('admin.categories.manageCategory')->with($param);
    }

}
