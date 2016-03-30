
@extends('user.details.detailsLayout')

    @section('tab-content')
        <div>
            <h3>Comment List</h3>
            <div class="row custom_row" style="height: 400px; overflow-y: auto; margin-bottom: 20px;">
            @foreach($commentList as $item)
            <div class="row custom_row">
                <div class="row custom_row comment_header">
                    <?php
                        $comment_time = strtotime($item->comment_time);
                        $delta_time_hour = date('H', time() - $comment_time);
                        $delta_time_minute = date('i', time() - $comment_time);
                    ?>
                    <h3><i class="fa fa-comments"></i><span>{{ $item->username }}</span> <span class="color_grey" style="font-size: 10pt;">about {{ $delta_time_hour }} hour {{ $delta_time_minute }} minute ago</span></h3>
                </div>
                <div class="row custom_row comment_content">
                    <p>{{ $item->content }}</p>
                </div>
                <div class="row custom_row comment_footer color_grey">
                    @if(Session::get('user_id') != '' && $item->user_id != Session::get('user_id'))
                        <h5><a href="javascript:;" onclick="addLikeDislike('{{ $item->mid }}', 'like');" class="color_green"><i class="fa fa-thumbs-up"></i></a> <span style="margin-right: 10px;">{{ $item->like_number }}</span> <a href="javascript:;" onclick="addLikeDislike('{{ $item->mid }}', 'dislike');" class="color_green"><i class="fa fa-thumbs-down"></i></a> <span>{{ $item->dislike_number }}</span></h5>
                    @else
                        <h5><i class="fa fa-thumbs-up"></i> <span style="margin-right: 10px;">{{ $item->like_number }}</span> <i class="fa fa-thumbs-down"></i> <span>{{ $item->dislike_number }}</span></h5>
                    @endif
                </div>

            </div>
            @endforeach
            </div>
            @if(Session::get('user_id') != '' && Session::get('user_type') == 4)
            <div class="row custom_row" style="margin-right: 20px;">
                <hr>
                <hr>
                <textarea rows="3" name="add_comment" id="add_comment" class="form-control" placeholder="Enter your comment here..."></textarea>
                <br>
                <button type="button" class="btn btn-success" onclick="addComment('{{ $fileItem->id }}');"><i class="fa fa-mail-forward"></i> Add Comment</button>
            </div>
            @endif
        </div>
    @stop

@stop
