@extends('layout.master')
@section('title', 'プログラミングＧＯ')
@php
    $page_intro = "【{$filter_form['difficulty'][$lessons['difficulty']]}】{$lessons['name']}　{$lessons['video_count']}本の動画で提供中";
@endphp
@section('breadcrumbs', Breadcrumbs::render('lesson_detail', $target, $page_intro))

@push('css')
    <link rel="stylesheet" href="/css/lesson/lesson_detail/detail.css">
    @pc
        <link rel="stylesheet" href="https://cdn.plyr.io/3.3.20/plyr.css">
    @endpc
@endpush

@push('js')
@pc
    <script src="https://cdn.plyr.io/3.3.20/plyr.js"></script>
    @diamond_user
        <script type="text/javascript" src="/js/video.diamond.js"></script>
    @else
        <script type="text/javascript" src="/js/video.normal.js"></script>
    @enddiamond_user
@else
    <script src="https://player.vimeo.com/api/player.js"></script>
@endpc
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js'></script>
    <script type="text/javascript" src="/js/ace.js"></script>
    <script type="text/javascript" src="/js/lesson/lesson_detail/lesson_detail.js"></script>
    <script type="text/javascript" src="/js/vimeo.js"></script>
@endpush

@section('content')
@php
    $redirect = route('login');
    if (Auth::check()) {
        if (Auth::user()->grade == USER_GRADE_NORMAL) {
            $redirect = route('user.upgrade');
        }
    }
@endphp
<div id="content">
    <div class="box ttlCommon border-bottom-0 mb-0 px-5">{{ $page_intro }}</div>
    <div class="box mb-0">
        <div class="card">
            <div class="lession-nar w-100 px-5"><span>{{ $target['name'] }}</span></div>
        </div>
    </div>
    <div class="box px-5 mb-0 mar_t20">
        @if ($target['url'])
        <div class="@sp player @endsp @pc player-yt @endpc">
            @php
                $video_css_class = 'j-video_deny';
                if ($allow_access) {
                    $video_css_class = 'j-video_allow';
                }

                $poster = array_shift($target['posters']);
                $poster_path = $poster['path'];
            @endphp

            @pc
                @if ($target['url'])
                <div class='j-maleContainer'>
                    <div id="j-player"
                        data-plyr-provider="vimeo"
                        data-plyr-embed-id="{{ $target['url'] }}"
                        class='{{ $video_css_class }}'>
                    </div>
                </div>
                @endif
                @if ($target['url_female'])
                <div class='j-femaleContainer hidden'>
                    <div id="j-playerFemale"
                        data-plyr-provider="vimeo"
                        data-plyr-embed-id="{{ $target['url_female'] }}"
                        class='{{ $video_css_class }}'>
                    </div>
                </div>
                @endif
            @else
                @if ($target['url'])
                <div class='j-maleContainer'>
                    <div id="j-vimeo_player"
                        data-vimeo-url="{{ $target['url'] }}"
                        data-vimeo-title="0"
                        data-vimeo-portrait="0"
                        data-vimeo-byline="0"
                        data-vimeo-responsive="1"
                        class='{{ $video_css_class }}'>
                    </div>
                </div>
                @endif
                @if ($target['url_female'])
                <div class='j-femaleContainer hidden'>
                    <div id="j-vimeo_player_female"
                        data-vimeo-url="{{ $target['url_female'] }}"
                        data-vimeo-title="0"
                        data-vimeo-portrait="0"
                        data-vimeo-byline="0"
                        data-vimeo-responsive="1"
                        class='{{ $video_css_class }}'>
                    </div>
                </div>
                @endif
            @endpc
            <div class="container-fluid">
                <div class="row box-request" @if (count($lesson_details) == 0) style="border-bottom: 0;" @endif>
                    <div class="@sp col-12 @endsp @pc col-8 @endpc pl-0 pr-0">
                        @if (Auth::check())
                            @php
                                if ($target['is_closeable']) {
                                    $text = '完了する';
                                    $css_class = 'bg-button-to-complete';
                                } else {
                                    $text = '完了';
                                    $css_class = 'bg-button-complete';
                                }
                            @endphp
                            @if ($allow_access)
                                <a href="javascript:;" class="btn-sm {{ $css_class }}  j-lessonDetailCloseReopen"
                                   data-href-close='{{ route('lesson_detail.close', ['lesson_id' => $target['lesson_id'], 'lesson_detail_id' => $target['id']]) }}'
                                   data-href-reopen='{{ route('lesson_detail.reopen', ['lesson_id' => $target['lesson_id'], 'lesson_detail_id' => $target['id']]) }}'
                                   data-action='{{ $target['is_closeable'] ? 'close' : 'reopen' }}'
                                 >
                                    {{ $text }}
                                </a>
                            @else
                                <a href="javascript:;" class="btn-sm {{ $css_class }}" data-toggle="modal" data-target="#modal_request_deny">
                                    {{ $text }}
                                </a>
                            @endif
                        @else
                            <a href="javascript:;" class="btn-sm bg-button-to-complete" style="opacity: .6;" data-toggle="modal" data-target="#modal_request_deny">完了する</a>
                        @endif

                        @unlogin
                            <a href="{{ route('register.diamond') }}" class="btn-sm bg-button-user-diamond">
                                <img class="img-fluid" src="/img/charge_diamond.png" width="16px;">
                                <span>月額会員に登録する</span>
                            </a>
                        @endunlogin
                        @normal_user
                            <a href="{{ route('user.upgrade') }}" class="btn-sm bg-button-user-diamond">
                                <img class="img-fluid" src="/img/charge_diamond.png" width="16px;">
                                <span>月額会員に登録する</span>
                            </a>
                        @endnormal_user

                        <a href="javascript:;" id='j-changeMale' class='lesson_detail--voice lesson_detail--voice__male j-switchVoice active'>
                            男性ボイス
                        </a>

                        @if ($target['url_female'])
                        <a href="javascript:;" class='lesson_detail--voice lesson_detail--voice__female j-switchVoice'
                              @if ($female_voice)
                                id='j-changeFemale'
                              @else
                                data-toggle="modal" data-target="#modal_request_female_voice"
                              @endif
                         >
                            女性ボイス
                        </a>
                        @endif
                    </div>

                    <div class="@sp col-12 @endsp @pc col-4 @endpc pl-0 pr-0 text-right">
                        @if ($prev_video)
                        <a class="btn-sm bg-button-paginate" href="{{ route('lesson_detail.detail', ['lesson_id' => $prev_video['lesson_id'], 'lesson_detail_id' => $prev_video['id']]) }}" title="{{ $prev_video['name'] }}">
                            前の動画
                        </a>
                        @endif
                        @if ($next_video)
                        <a class="btn-sm bg-button-paginate" href="{{ route('lesson_detail.detail', ['lesson_id' => $next_video['lesson_id'], 'lesson_detail_id' => $next_video['id']]) }}" title="{{ $next_video['name'] }}">
                            次の動画
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="box">
        <div class="row">
            @pc
                @php $model_id = 'modal_' . $target['lesson_id'] . $target['id']; @endphp
                @include('component.lesson.lesson_detail.lesson_detail_info_pc', ['modal_id' => $model_id, 'resources' => $target['resources'], 'resources_item' => $target['resources_item'] ?? [], 'content' => $target['source_code_contents'], 'lesson_id' => $target['lesson_id'], 'lesson_detail_id' => $target['id'], 'allow_access' => $allow_access])
            @endpc
            @sp
                @php $model_id = 'modal_' . $target['lesson_id'] . $target['id']; @endphp
                @include('component.lesson.lesson_detail.lesson_detail_info_sp', ['modal_id' => $model_id, 'resources' => $target['resources'], 'resources_item' => $target['resources_item'] ?? [], 'content' => $target['source_code_contents'], 'lesson_id' => $target['lesson_id'], 'lesson_detail_id' => $target['id'], 'allow_access' => $allow_access])
            @endsp
        </div>
    </div>
</div>
@include('component.modal.video_speed', ['modal_id' => 'modal_diamond_user'])
@include('component.modal.video_deny', ['modal_id' => 'modal_video_deny'])
@include('component.modal.request_deny', ['modal_id' => 'modal_request_deny'])
@include('component.modal.resource_download_deny', ['modal_id' => 'modal_resource_download_deny'])
@include('component.modal.request_female_voice', ['modal_id' => 'modal_request_female_voice'])

@stop