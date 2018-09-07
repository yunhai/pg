@extends('layout.master')
@section('title', 'プログラミングＧＯ')
@push('css')
    <link rel="stylesheet" href="/css/lesson/lesson_detail/detail.css">
@endpush

@push('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js'></script>
    <script type="text/javascript" src="/js/lesson/filter.js"></script>
    <script type="text/javascript" src="/js/ace.js"></script>
    <script type="text/javascript" src="/js/lesson/lesson_detail/lesson_detail.js"></script>
    <script type="text/javascript">
        $('.carousel').carousel()
    </script>
@endpush

@section('content')
@if (Auth::check() == false)
    @include('component.top.panel', ['youtube_link' => $youtube_link])
    @include('component.top.video', ['lessons' => $lessons])
@else
    @include('component.top.lesson', ['lessons' => $lessons])
@endif

<div class="box mb-0">
    <div class="card-lesson-total text-center">
        <p class="card-text">
            <a href="{{ route('lesson') }}">全てのレッスンを見る（{{ $global_total_lessons }}）</a>
        </p>
    </div>
</div>
@include('component.modal.request_login', ['modal_id' => 'modal_request_login'])
@include('component.modal.request_deny', ['modal_id' => 'modal_request_deny'])
@stop