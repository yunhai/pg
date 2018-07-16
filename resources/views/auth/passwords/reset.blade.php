@extends('layout.master')
@section('title', 'パスワードの再設定')
@section('breadcrumbs', Breadcrumbs::render('password.request'))
@section('content')
<div id="content">
    <div class="box mb-0"><h2 class="ttlCommon">パスワードの再設定</h2></div>
    <div class="container mar_b30">
        <p class="mar_t30 mar_b30">パスワードを再設定するには以下から新しいパスワードを入力してください。</p>
        <div class="row">
            <div class="col-3 d-none d-lg-block">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                    <a class="nav-link" href="{{ route('login') }}" role="tab">ログイン</a>
                    <a class="nav-link" href="/register" role="tab">新規ユーザー登録</a>
                    <a class="nav-link active show" href="{{ route('password.request') }}" role="tab">パスワードを忘れた？</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade active show" role="tabpanel">
                        <div class="row justify-content-left">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">パスワードの再設定</div>

                                    <div class="card-body">

                                        <form method="POST" action="{{ route('password.request') }}" aria-label="パスワードの再設定">
                                            @csrf

                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">登録メールアドレス</label>

                                                <div class="col-md-7">
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" autofocus>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">新パスワード</label>

                                                <div class="col-md-7">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">新パスワード (確認)</label>

                                                <div class="col-md-7">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-7 offset-md-4">
                                                    <button type="submit" class="btn btn-default">
                                                        パスワードを再設定する
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 d-none d-lg-block">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <div class="card">
                        <div class="card-header text-center">ご注意</div>

                        <div class="card-body">
                            <p class="mar_b0">パスワードは他の人から推測されにくいものにしましょう。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
