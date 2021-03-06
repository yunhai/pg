@extends('layout.master')
@section('title', $target['name'] . ' | プログラミングＧＯ')
@section('meta_description', $target['name'])
@section('breadcrumbs', Breadcrumbs::render('lesson.detail', $target['name']))

@php $time = time(); @endphp
@push('css')
    <link rel="stylesheet" href="/css/lesson/lesson_detail/detail.css?{{ $time }}">
@endpush

@push('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js'></script>
    <script type="text/javascript" src="/js/ace.js?{{ $time }}"></script>
    <script type="text/javascript" src="/js/lesson/lesson_detail/lesson_detail.js?{{ $time }}"></script>
@endpush

@section('content')
@php
    $count = 381;
    if (!empty($stat[$target['id']])) {
        $count = number_format($stat[$target['id']] + 381);
    }
@endphp
<div id="content">
    <div class="content box mb-0" @if (count($target['lesson_details']) > 0) style="min-height: auto; !important" @endif>
        <div class="card">
            <div class="lession-heading w-100 px-5">
                <img class="img-fluid" src="/img/light-bulb.png">
                <div class="@pc col-10 @endpc pr-0 pad_l5 font-weight-bold">
                    <span>【{{ $filter_form['difficulty'][$target['difficulty']] }}】【＃{{ $target['sort'] }}】{{ $target['name'] }}（全{{ $target['video_count'] }}回）</span>
                </div>
                @pc
                <div class="@pc col-2 @endpc @sp col-5 @endsp">
                    <span class="lession-heading-url float-right">{{ $count }} 人が学習中です</span>
                </div>
                @endpc
            </div>
        </div>
        <div class="card card-video-list">
            <div class="container-fluid box-sp px-5">
                @include('component.lesson.item', ['lesson_details' => $target['lesson_details']])
            </div>
        </div>
    </div>
</div>

@include('component.modal.request_deny', ['modal_id' => 'modal_request_deny'])
@include('component.modal.request_login', ['modal_id' => 'modal_request_login'])
@stop
