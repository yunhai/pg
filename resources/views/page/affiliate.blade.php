@extends('layout.master')
@section('title', 'レッスン一覧')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('affiliate'))
<div id="content">
    <div class="box mb-0"><h2 class="ttlCommon mb-0">アフィリエイト</h2></div>
    <div class="row box-lesson mar_t30" style="background-color: #fff">
        <div class="container-fluid">
            <p>継続報酬型アフィリエイト</p>
            <p>報酬：１ユーザー購入した場合止めない、￥１００円</p>
        </div>
    </div>
</div>
@stop