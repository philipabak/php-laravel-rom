<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html, Mail;
use App\User as UserModel;
use App\Region as RegionModel;
use App\Membertype as MembertypeModel;
use App\Membershipplan as MembershipplanModel;
use App\Message as MessageModel;
use App\Downloadhistory as DownloadhistoryModel;
use App\Downloadlist as DownloadlistModel;
use App\Purchasehistory as PurchasehistoryModel;
use App\Category as CategoryModel;
use App\File as FileModel;

class CategoryController extends BaseController
{
    public function __construct()    {
/*
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('user.user.signin');
            }
        });
*/
    }

    public function getCategory()
    {
        //
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


        return Response::json(['result' => 'success', 'data' => $categoryList, 'k'=>$k]);
    }

    public function listCategory($slug1, $slug)
    {
        $param = [];

        $categoryItem = CategoryModel::where('slug',$slug)->get();
        $parentItem = CategoryModel::find($categoryItem[0]->parent_id);

        $fileList = FileModel::where('category_id', $categoryItem[0]->id)->paginate(5);
        $param['categoryItem'] = $categoryItem[0];
        $param['parentItem'] = $parentItem;
        $param['fileList'] = $fileList;
        $param['title'] = 'Browse Category';
        return View::make('user.category.browseCategory')->with($param);
    }

}
