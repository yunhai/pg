@extends('layout.master')
@section('title', 'お問い合わせ')

@section('content')
<!-- HEADER -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">トップ</li>
    <li class="breadcrumb-item active" aria-current="page">お問い合わせ</li>
  </ol>
</nav>
<div id="content">
    <h2 class="ttlCommon">お問い合わせ</h2>
    <div class="container mar_b30">
        <div class="col-12 mar_t30">
            <div class="container-fluid">
                <div class="col">
                    <div class="card">
                        <div class="card-header">お問い合わせ</div>
        
                        <div class="card-body">
                            <form method="POST" action="" aria-label="お問い合わせ" class="form-c">
                                @csrf
        
                                <div class="form-group">
                                    <label for="name">お名前<span class="required">（必須）</span></label>
                                    <input class="form-control w-50" name="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="name">メールアドレス<span class="required">（必須）</span></label>
                                    <input class="form-control w-50" name="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="name">電話番号</label>
                                    <input class="form-control w-50" name="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="name">内容<span class="required">（必須）</span></label>
                                    <textarea class="form-control" rows="10" name="" placeholder=""></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-primary" value="送信">
                                </div>
                                <p class="mb-0 text-center">＊土曜日、日曜日、休日、年始、定休日を除き２４時間以内に担当者からご連絡いたします。</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection