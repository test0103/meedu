@extends('layouts.app')

@section('css')
    <link href="https://cdn.bootcss.com/plyr/3.2.1/plyr.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/social-share.js/1.0.16/css/share.min.css" rel="stylesheet">
    <style>
        .navbar { background-color: #000000; }
    </style>
@endsection

@section('content')

    <div class="container-fluid video-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 play-box">
                            <video id="player" playsinline controls>
                                <source src="" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-sm-3 play-list">
                            <ul>
                                @foreach($video->course->getVideos() as $index => $videoItem)
                                    <a href="{{ route('video.show', [$video->course->id, $videoItem->id, $videoItem->slug]) }}">
                                        <li data-index="{{ $index }}" class="{{ $videoItem->id == $video->id ? 'active' : '' }}">
                                            <i class="fa fa-play-circle-o" aria-hidden="true"></i> {{ $videoItem->title }}
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 15px;">
        <div class="row">
            <div class="col-sm-9 video-play-comment-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ $video->title }}
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12" style="margin-bottom: 20px;">
                                    <h3></h3>
                                    <p class="color-gray">{{ $video->short_description }}</p>
                                </div>

                                <div class="social-share" style="margin-bottom: 10px;"></div>

                                <hr>

                                <div class="col-sm-12">
                                    <div class="alert alert-warning">
                                        <p>1.支持Markdown语法</p>
                                        <p>2.支持 @ 某个人，当你 @ TA的时候我们会发站内消息给TA的</p>
                                        <p>3.支持拖拽图片到评论框上传</p>
                                        <p>4.支持emoji表情</p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <form action="{{ route('video.comment', $video) }}" method="post" class="form-horizontal">
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <textarea class="form-control" rows="2" placeholder="评论内容" name="content"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button class="btn btn-primary">提交评论</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                评论内容
                            </div>
                            <div class="panel panel-body">
                                <table class="comment-list-box">
                                    <tbody>
                                    @forelse($video->comments as $comment)
                                    <tr class="comment-list-item">
                                        <td width="70" class="user-info">
                                            <p><img class="avatar" src="{{$comment->user->avatar}}" width="50" height="50"></p>
                                            <p class="nickname">{{$comment->user->nick_name}}</p>
                                        </td>
                                        <td class="comment-content">
                                            <p>{!! $comment->getContent() !!}</p>
                                            <p class="text-right color-gray">{{$comment->created_at->diffForHumans()}}</p>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center color-gray" colspan="2">0评论</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-sm-3 video-play-right-box">

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.bootcss.com/plyr/3.2.1/plyr.min.js"></script>
    <script src="https://cdn.bootcss.com/social-share.js/1.0.16/js/social-share.min.js"></script>
    @include('components.frontend.emoji')
    @include('components.frontend.comment_js')
@endsection