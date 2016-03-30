<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Mail, Validator, Html;
use App\User as UserModel;
use App\Region as RegionModel;
use App\Membertype as MembertypeModel;
use App\Membershipplan as MembershipplanModel;
use App\Message as MessageModel;
use App\Downloadhistory as DownloadhistoryModel;
use App\Downloadlist as DownloadlistModel;
use App\Purchasehistory as PurchasehistoryModel;

class ProfileController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('user.user.signin');
            }
        });
    }

    public function dashboard()
    {
        $param = array();

        $userItem = UserModel::find(Session::get('user_id'));
        $downloadHistoryList = DownloadhistoryModel::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->limit(4)->get();
        $downloadList = DownloadlistModel::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->limit(4)->get();
        $purchaseHistoryList = PurchasehistoryModel::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->limit(4)->get();

        $param['downloadHistoryList'] = $downloadHistoryList;
        $param['downloadList'] = $downloadList;
        $param['purchaseHistoryList'] = $purchaseHistoryList;
        $param['userItem'] = $userItem;
        $param['title'] = 'Profile Dashboard';
        $param['tab'] = 'dashboard';
        return View::make('user.profile.dashboard')->with($param);
    }

    public function messages()
    {
        $param = array();

        $messageList = DB::table('messages')
                            ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                            ->where('messages.parent_id', 26)
                            ->groupby('messages.user_id')
                            ->get();

        $param['messageList'] = $messageList;
        $param['title'] = 'Profile Messages';
        $param['tab'] = 'messages';
        return View::make('user.profile.messages')->with($param);
    }

    public function community()
    {
        $param = array();

        $userItem = UserModel::find(Session::get('user_id'));

        $param['userItem'] = $userItem;
        $param['title'] = 'Profile Community';
        $param['tab'] = 'community';
        return View::make('user.profile.community')->with($param);
    }

    public function downloadList()
    {
        $param = array();

        $downloadList = DownloadlistModel::where('user_id', Session::get('user_id'))->paginate(5);

        $param['downloadList'] = $downloadList;
        $param['title'] = 'Profile Download List';
        $param['tab'] = 'downloadList';
        return View::make('user.profile.downloadList')->with($param);
    }

    public function downloadHistory()
    {
        $param = array();

        $downloadHistoryList = DownloadhistoryModel::where('user_id', Session::get('user_id'))->paginate(5);

        $param['downloadHistoryList'] = $downloadHistoryList;
        $param['title'] = 'Profile Download History';
        $param['tab'] = 'downloadHistory';
        return View::make('user.profile.downloadHistory')->with($param);
    }

    public function purchaseHistory()
    {
        $param = array();

        $purchaseHistoryList = PurchasehistoryModel::where('user_id', Session::get('user_id'))->paginate(5);

        $param['purchaseHistoryList'] = $purchaseHistoryList;
        $param['title'] = 'Profile Purchase History';
        $param['tab'] = 'purchaseHistory';
        return View::make('user.profile.purchaseHistory')->with($param);
    }

    public function updateProfileInforms()
    {
        $param = array();
        $userItem = UserModel::find(Session::get('user_id'));

        $userItem->email = Input::get('email');
        $userItem->password = md5(Input::get('password'));

        $userItem->save();

        $downloadHistoryList = DownloadhistoryModel::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->limit(4)->get();
        $downloadList = DownloadlistModel::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->limit(4)->get();
        $purchaseHistoryList = PurchasehistoryModel::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->limit(4)->get();

        $param['downloadHistoryList'] = $downloadHistoryList;
        $param['downloadList'] = $downloadList;
        $param['purchaseHistoryList'] = $purchaseHistoryList;

        $param['userItem'] = $userItem;
        $param['title'] = 'Profile Dashboard';
        $param['message'] = 'Updated successfully!';
        $param['tab'] = 'dashboard';
        return View::make('user.profile.dashboard')->with($param);
    }

    public function getMessageContent($partner_id)
    {
        $param = [];

        Session::set('partner_id', $partner_id);
        $messageContent = DB::table('messages')
                            ->where(function($query1){
                                $query1->where('parent_id', Session::get('partner_id'))
                                       ->where('user_id', Session::get('user_id'));
                            })
                            ->orwhere(function ($query2) {
                                $query2->where('parent_id', Session::get('user_id'))
                                    ->where('user_id', Session::get('partner_id'));
                            })
                            ->orderby('created_at', 'ASC')
                            ->get();

        return Response::json(['result' => 'success', 'messageContent' => $messageContent]);
    }

    public function sendReplyMessage()
    {

//Send email
        $partnerItem = UserModel::find(Session::get('partner_id'));

        $data = array();
        $data['subject'] = 'Reply';
        $data['to_usr'] = $partnerItem->email;
        $data['from_usr'] = Session::get('user_email');
        $data['body'] = Input::get('reply_content');
        $data['title'] = 'Mail Send';

        $userItem = UserModel::find(Session::get('user_id'));
        $data['from_name'] = $userItem->first_name . ' ' . $userItem->last_name;
        $data['photo_url'] = url() . '/assets/backend/img/avatars/' . $userItem->photo;

        $name = $data['from_name'];
        $from_address = $data['from_usr'];
        $to_address = $data['to_usr'];
        $subject = $data['subject'];

        Mail::send('admin.messages.mailSend', $data, function ($message) use ($from_address, $name, $to_address, $subject) {
            $message->from($from_address, $name);
            $message->to($to_address);
            $message->subject($subject);
        });
//end
//store message
        $check_id = UserModel::where('email', $to_address)->get();
        if(count($check_id) > 0) $parent_id = $check_id[0]->id;
        else $parent_id = 0;

        $insertMessage = new MessageModel;

        $insertMessage->parent_id = $parent_id;
        $insertMessage->numprnt_id = 0;
        $insertMessage->user_id = Session::get('user_id');
        $insertMessage->subject = $subject;
        $insertMessage->body = $data['body'];
        $insertMessage->to_usr = $to_address;
        $insertMessage->from_usr = $from_address;
        $insertMessage->status = 1;

        $insertMessage->save();

        return Response::json(['result' => 'success', 'replyMessageContent' => $insertMessage]);
    }

    public function removeMessage()
    {

//delete message
        $deletePartnerMessage = MessageModel::where('parent_id', Session::get('partner_id'))->where('user_id', Session::get('user_id'));
        $deletePartnerMessage->delete();
        $deleteUserMessage = MessageModel::where('parent_id', Session::get('user_id'))->where('user_id', Session::get('partner_id'));
        $deleteUserMessage->delete();

        return Response::json(['result' => 'success']);
    }

    public function sendNewMessage()
    {

//Send email
        $data = array();
        $data['subject'] = Input::get('subject');
        $data['to_usr'] = Input::get('to_usr');
        $data['from_usr'] = Session::get('user_email');
        $data['body'] = Input::get('body');
        $data['title'] = 'Mail Send';

        $userItem = UserModel::find(Session::get('user_id'));
        $data['from_name'] = $userItem->first_name . ' ' . $userItem->last_name;
        $data['photo_url'] = url() . '/assets/backend/img/avatars/' . $userItem->photo;

        $name = $data['from_name'];
        $from_address = $data['from_usr'];
        $to_address = $data['to_usr'];
        $subject = $data['subject'];
        \Mail::send('admin.messages.mailSend', $data, function ($message) use ($from_address, $name, $to_address, $subject) {
            $message->from($from_address, $name);
            $message->to($to_address);
            $message->subject($subject);
        });

//end
//store message
        $check_id = UserModel::where('email', $to_address)->get();
        if(count($check_id) > 0) $parent_id = $check_id[0]->id;
        else $parent_id = 0;

        $insertMessage = new MessageModel;

        $insertMessage->parent_id = $parent_id;
        $insertMessage->numprnt_id = 0;
        $insertMessage->user_id = Session::get('user_id');
        $insertMessage->subject = $subject;
        $insertMessage->body = $data['body'];
        $insertMessage->to_usr = $to_address;
        $insertMessage->from_usr = $from_address;
        $insertMessage->status = 1;

        $insertMessage->save();

        return Response::json(['result' => 'success', 'data' => $data]);
    }

}
