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
use App\Comment as CommentModel;
use App\Likedislike as LikedislikeModel;

class DetailsController extends BaseController
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

    public function details($slug1, $slug2, $slug, $option)
    {
        $param = [];

        if($option == 'details') {
            $fileItem = FileModel::where('slug', $slug)->get();
            $categoryItem = CategoryModel::find($fileItem[0]->category_id);
            $region = RegionModel::find($fileItem[0]->region);
            $parentItem = CategoryModel::find($categoryItem->parent_id);

            $commentList = DB::table('comments')
                ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                ->select('comments.id as mid', 'comments.*', 'users.*')
                ->where('comments.file_id', $fileItem[0]->id)
                ->get();

            $param['categoryItem'] = $categoryItem;
            $param['region'] = $region;
            $param['parentItem'] = $parentItem;
            $param['fileItem'] = $fileItem[0];
            $param['commentList'] = $commentList;
            $param['title'] = 'File Details';
            $param['tab'] = 'details';
            return View::make('user.details.browseDetails')->with($param);
        }elseif($option == 'comments'){
            $fileItem = FileModel::where('slug', $slug)->get();
            $commentList = DB::table('comments')
                ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                ->select('comments.id as mid', 'comments.created_at as comment_time', 'comments.*', 'users.*')
                ->where('comments.file_id', $fileItem[0]->id)
                ->get();
            $categoryItem = CategoryModel::find($fileItem[0]->category_id);
            $parentItem = CategoryModel::find($categoryItem->parent_id);


            $param['categoryItem'] = $categoryItem;
            $param['parentItem'] = $parentItem;
            $param['commentList'] = $commentList;
            $param['fileItem'] = $fileItem[0];
            $param['title'] = 'Comments';
            $param['tab'] = 'comments';
            return View::make('user.details.commentsDetails')->with($param);
        }else{
            $fileItem = FileModel::where('slug', $slug)->get();
            $categoryItem = CategoryModel::find($fileItem[0]->category_id);
            $parentItem = CategoryModel::find($categoryItem->parent_id);
            $region = RegionModel::find($fileItem[0]->region);


            $param['categoryItem'] = $categoryItem;
            $param['parentItem'] = $parentItem;
            $param['fileItem'] = $fileItem[0];
            $param['region'] = $region;
            $param['title'] = 'Download';
            return View::make('user.details.fileDownload')->with($param);
        }

    }

    public function comments($slug1, $slug2, $slug)
    {
        $param = [];

        $fileItem = FileModel::where('slug', $slug)->get();
        $commentList = DB::table('comments')
                            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                            ->select('comments.id as mid', 'comments.created_at as comment_time', 'comments.*', 'users.*')
                            ->where('comments.file_id', $fileItem[0]->id)
                            ->get();
        $categoryItem = CategoryModel::find($fileItem[0]->category_id);
        $parentItem = CategoryModel::find($categoryItem->parent_id);


        $param['categoryItem'] = $categoryItem;
        $param['parentItem'] = $parentItem;
        $param['commentList'] = $commentList;
        $param['fileItem'] = $fileItem[0];
        $param['title'] = 'Comments';
        $param['tab'] = 'comments';
        return View::make('user.details.commentsDetails')->with($param);
    }

    public function addLikeDislike($type, $mid)
    {
        //
        $check_exist = LikedislikeModel::where('user_id', Session::get('user_id'))->where('comment_id', $mid)->get();
        if(count($check_exist) > 0) {
            $refresh_flag = 0;
        }else {
            $refresh_flag = 1;

            $addItem = new LikedislikeModel;

            $addItem->user_id = Session::get('user_id');
            $addItem->comment_id = $mid;
            $addItem->type = $type;

            $addItem->save();

            $commentItem = CommentModel::find($mid);

            if($type == 'like') {
                $commentItem->like_number = $commentItem->like_number + 1;
            }else{
                $commentItem->dislike_number = $commentItem->dislike_number + 1;
            }
            $commentItem->save();
        }

        return Response::json(['result' => 'success', 'refresh_flag' => $refresh_flag]);
    }

    public function addComment($fid)
    {
        //
        $comment_content = Input::get('comment_content');

        $addItem = new CommentModel;

        $addItem->user_id = Session::get('user_id');
        $addItem->file_id = $fid;
        $addItem->content = $comment_content;

        $addItem->save();

        return Response::json(['result' => 'success']);
    }

    public function addDownloadList($fid)
    {
        //
        $fileItem = FileModel::find($fid);

        $addItem = new DownloadlistModel;

        $addItem->user_id = Session::get('user_id');
        $addItem->file_id = $fid;
        $addItem->title = $fileItem->title;
        $addItem->size = $fileItem->file_size;

        $addItem->save();

        return Response::json(['result' => 'success']);
    }

    public function download($fid)
    {
        //
        $fileItem = FileModel::find($fid);
        $file = public_path() . '/' . $fileItem->file_path . $fileItem->file;
        $headers = array(
            'Content-Type: application/octet-stream',
        );
        return Response::download($file, $fileItem->file, $headers);
    }

}
