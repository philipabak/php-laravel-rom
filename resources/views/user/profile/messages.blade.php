
@extends('user.profile.profileLayout')

    @section('tab-content')
        <div>
            <div class="col-xs-12 col-sm-4" style="height: 500px; overflow-y: auto;">
                <a href="javascript:;" onclick="newMessage();" class="big-button new-message">NEW MESSAGE <i class="fa fa-comment-o"></i></a>
                <ul class="friend-messages">
                    @foreach($messageList as $item)
                    <li class="messageList"><a href="javascript:;" onclick="getMessages('{{ $item->user_id }}', '{{ $item->username }}');"><img src="/assets/backend/img/avatars/{{ $item->photo }}" alt="" class="friend-photo"><p class="friend-name">{{ $item->username }}</p><span class="user-email">{{--{{ $item->email }}--}}</span></a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-xs-12 col-sm-8" id="newMessageContent" style="display: none;">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <div>
                    <p class="convo-title">
                        New Message
                    </p>
                    <hr>
                </div>

                <div>
                    <p style="color: green; font-weight: bold; display: none;" id="successBox">Your message have sent.</p>
                    <div class="input-group" style="margin-bottom: 20px;">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" class="form-control" placeholder="Email" name="to_usr" id="to_usr">
                    </div>
                    <div class="input-group" style="margin-bottom: 20px;">
                        <span class="input-group-addon"><i class="fa fa-tasks"></i></span>
                        <input class="form-control" type="text" placeholder="Subject" name="subject" id="subject">
                    </div>
                    <textarea rows="10" name="body" id="body" class="form-control" placeholder="Enter your message here..."></textarea>
                </div>

                <div>
                    <hr>
                    <br>
                    <img id="loading_img1" style="display: none; margin-bottom: -20px;" src="/assets/frontend/images/loading_spinner.gif" width="60">
                    <button type="button" onclick="sendNewMessage();" class="btn btn-primary" id="sendM" style="margin-top: 20px;"><i class="fa fa-mail-forward"></i> Send</button>
               </div>
            </div>

            <div class="col-xs-12 col-sm-8" id="messageContent">
                <div>
                    <p class="convo-title" id="convoTitle"></p>
                    <hr>
                </div>

                <div id="message_content"></div>

                <div>
                    <hr>
                    <textarea rows="3" name="reply" id="reply" class="form-control" placeholder="Enter your reply here..."></textarea>
                    <br>
                    <img id="loading_img" style="display: none;" src="/assets/frontend/images/loading_spinner.gif" width="60">
                    <button type="button" class="btn btn-primary" onclick="sendMessage();"><i class="fa fa-mail-forward"></i> Send</button>
                    <button type="button" class="btn btn-danger" onclick="removeMessage();" style="float: right;"><i class="fa fa-trash-o"></i> Remove All</button>
                    <img id="loading_img1" style="display: none; float:right;margin-top: -12px;" src="/assets/frontend/images/loading_spinner.gif" width="60">
               </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                var first_id = '{{ $messageList[0]->user_id }}';
                var first_username = '{{ $messageList[0]->username }}';
                getMessages(first_id, first_username);

            });

            function getMessages(partner_id, partner_username) {

                $('#newMessageContent').css('display', 'none');
                $('#messageContent').css('display', 'inline-block');

                var html_conent = 'Conversation between <span>' + partner_username + '</span> and <span>You</span>.';
                $('#convoTitle').empty();
                $('#convoTitle').append(html_conent);

                var message_content = '';
                $('#loading_img').css('display', 'inline-block');
                $.ajax({
                    type: "Get",
                    url: "/getMessageContent/" + partner_id,
                    success: function(result){
                        for(var i=0;i<result.messageContent.length;i++){
                            if(result.messageContent[i].user_id == partner_id){
                                message_content += '<p class="message-outgoing">' + result.messageContent[i].body + ' <span class="time-stamp">' + result.messageContent[i].created_at + '</span></p>';
                            }else{
                                message_content += '<p class="message-incoming">' + result.messageContent[i].body + ' <span class="time-stamp">' + result.messageContent[i].created_at + '</span></p>';
                            }
                        }
                        $('#loading_img').css('display', 'none');
                        $('#message_content').empty();
                        $('#message_content').append(message_content);
                    },
                });
            }

            function sendMessage() {
                var reply_content = $('#reply').val();
                if(!reply_content){
                    alert("Please type the text.");
                    return false;
                }
                var message_content = '';
                $('#loading_img').css('display', 'inline-block');
                $.ajax({
                    type: "Get",
                    url: "/sendReplyMessage",
                    data: { reply_content: reply_content },
                    success: function(result){
                        $('#loading_img').css('display', 'none');
                        $('#reply').val('');
                        message_content = '<p class="message-incoming">' + result.replyMessageContent.body + ' <span class="time-stamp">' + result.replyMessageContent.created_at + '</span></p>';
                        $('#message_content').append(message_content);
                    },
                });
            }

            function removeMessage() {
                var message_content = '';
                $('#loading_img1').css('display', 'inline-block');
                $.ajax({
                    type: "Get",
                    url: "/removeMessage",
                    data: {},
                    success: function(result){
                        $('#loading_img1').css('display', 'none');
                        $('#reply').val('');
                        $('#message_content').html(message_content);
                    },
                });
            }

            function newMessage(){
                $('#newMessageContent').css('display', 'inline-block');
                $('#messageContent').css('display', 'none');
            }

            function sendNewMessage(){
                var to_usr = $('#to_usr').val();
                var subject = $('#subject').val();
                var body = $('#body').val();

                if(!to_usr || !subject || !body){
                    alert("Please type all fields.");
                    return false;
                }
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(to_usr)){
                    alert("Your address is invalid, please type email address again.");
                    return false;
                }

                $('#loading_img1').css('display', 'inline-block');
                $.ajax({
                    type: "Get",
                    url: "/sendNewMessage",
                    data: { body: body, to_usr: to_usr, subject: subject },
                    success: function(result){
                        $('#loading_img1').css('display', 'none');
                        $('#to_usr').val('');
                        $('#subject').val('');
                        $('#body').val('');
                        $('#titleBox').css('display', 'inline-block');
                    },
                });
            }

        </script>
    @stop

@stop



