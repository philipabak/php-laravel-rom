<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use View, Session, Redirect, Input, DB, Auth, Request, Response, Validator, Html, Mail;
use App\User as UserModel;
use App\Message as MessageModel;

class MessagesController extends BaseController
{
    public function __construct()    {
        $this->beforeFilter(function () {
            if (Session::has('role') != 'Admin') {
                return Redirect::route('user.user.index');
            }
        });
    }

    public function inbox()
    {
        $param = array();
        $inboxMessages = MessageModel::where('parent_id', Session::get('user_id'))->where('status', 1)->get();
        $param['inboxMessages'] = $inboxMessages;
        $param['title']         = 'Messages | Inbox';
        return View::make('admin.messages.inbox')->with($param);
    }

    public function composeNew()
    {

//Send email
        $data = array();
        $data['subject'] = Input::get('subject');
        $data['to_usr'] = Input::get('to_usr');
        $data['from_usr'] = Input::get('from_usr');
        $data['body'] = Input::get('body');
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

        $param['message'] = 'Mail sent.';

        $sentMessages = MessageModel::where('user_id', Session::get('user_id'))->where('status', 1)->get();
        $param['sentMessages'] = $sentMessages;
        $param['title']         = 'Messages | Sent';
        return View::make('admin.messages.sent')->with($param);

    }

    public function reply()
    {

//Send email
        $data = array();
        $data['mid'] = Input::get('mid');
        $data['subject'] = Input::get('subject');
        $data['to_usr'] = Input::get('to_usr');
        $data['from_usr'] = Input::get('from_usr');
        $data['body'] = Input::get('body');
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

        $param['message'] = 'Mail sent.';

        $sentMessages = MessageModel::where('user_id', Session::get('user_id'))->where('status', 1)->get();
        $param['sentMessages'] = $sentMessages;
        $param['title']         = 'Messages | Sent';
        return View::make('admin.messages.sent')->with($param);
    }

    public function sentMail()
    {
        //
        $param = array();
        $sentMessages = MessageModel::where('user_id', Session::get('user_id'))->where('status', 1)->get();
        $param['sentMessages'] = $sentMessages;
        $param['title']         = 'Messages | Sent';
        return View::make('admin.messages.sent')->with($param);
    }

    public function trash()
    {
        //
        $param = array();
        $trashMessages = MessageModel::where('parent_id', Session::get('user_id'))->orwhere('user_id', Session::get('user_id'))->where('status', 0)->get();
        $param['trashMessages'] = $trashMessages;
        $param['title']         = 'Messages | Sent';
        return View::make('admin.messages.trash')->with($param);
    }

    public function details($mid)
    {
        //
        $message_detail     = MessageModel::find($mid);
        $user_detail        = UserModel::find($message_detail->user_id);

        $subject            = $message_detail->subject;
        $photo              = $user_detail->photo;
        $first_name         = $user_detail->first_name;
        $last_name          = $user_detail->last_name;
        $photo_url          = '/assets/backend/img/avatars/' . $photo;
        $from               = $message_detail->from_usr;
        $body               = $message_detail->body;
        $to                 = $message_detail->to_usr;

        $html_content ='
                <a href="#email-list" role="tab" data-toggle="tab" class="btn bg-purple2 btn-sm mr10 mail-toggle" style="float: left;">
                    <span class="glyphicons glyphicons-unshare mr5"></span>
                </a>
                <span class="pull-right text-muted m5">' . date('Y-m-d H:i') . '</span>
                <h3><span class="text-orange2">Subject - </span>'.$subject.'</h3>
                <hr class="mt10 mb10"/>
                <img src="'.$photo_url.'" class="img-responsive mw50 pull-left mr20">
                <div class="pull-right mt5">' .
/*                    <span class="label bg-blue2 mr10">New</span> <span class="label bg-green2">Co-Worker</span>*/
                '</div>
                <h4 class="mt15 mb5">From: ' . $first_name . ' ' . $last_name . '</h4>
                <small class="text-muted">From: '.$from.'</small>
                <div class="clearfix"></div>
                <hr class="mb15 mt10">
                <p>'.$body.'</p>
                <hr class="mb15 mt15"/>' .
/*                <h4 class="mb25"> <span class="glyphicons glyphicons-paperclip mr10"></span> 3 Attachments - <small> View Images | Download All</small> </h4>
                <div class="attachments mb30">
                    <img src="/assets/backend/img/stock/12.jpg" class="mw140 mr15"> <img src="/assets/backend/img/stock/7.jpg" class="responsive mw140 mr15"> <img src="/assets/backend/img/stock/4.jpg" class="responsive mw140">
                </div>*/

                '<h4 class="mb25"> <span class="glyphicons glyphicons-share mr10"></span> Reply </h4>

                <form method="post" action="/admin/messages/reply">
                    <input type="hidden" name="_token" id="_token" value="' . csrf_token() . '">
                    <input type="hidden" value="'.$mid.'" name="mid"/>
                    <input type="hidden" value="'.$from.'" name="to_usr"/>
                    <input type="hidden" value="'.$to.'" name="from_usr"/>
                    <input type="hidden" value="'.$subject.'(Reply)" name="subject"/>
                    <textarea name="body" rows="10" cols="100"/>
                    <button class="btn bg-grey2 pull-right" type="submit" id="replyM"><span class="glyphicons glyphicons-share mr10"></span>Send</button>
                </form>

                <div class="row mb5 mt10"></div>

                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        "use strict";

                        $("#reply").on("click", function() {
                             var message1 = $("#reply").html();
                             alert(message1);
                        });

                        $(".summernote").summernote({
                             height: 315,
                             focus: false  //set focus editable area after Initialize summernote
                        });

                        $( ".note-editable" ).addClass( "reply" );
                        $( ".note-editable" ).attr( "id","reply" );

                    });
                </script>
                ';

        return Response::json(['html_content' => $html_content, 'result' => 'success']);

    }

    public function messageTrash($mid)
    {
        //
        $message_detail     = MessageModel::find($mid);

        $message_detail->status = 0;

        $message_detail->save();

        return Response::json(['result' => 'success']);

    }


    public function messageDelete($mid)
    {
        //
        $message_detail     = MessageModel::find($mid);

        $message_detail->delete();

        return Response::json(['result' => 'success']);

    }

}
