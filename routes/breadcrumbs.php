<?php
// トップ
Breadcrumbs::for('top', function ($trail) {
    $trail->push('トップ', route('top'));
});

// マイページ
Breadcrumbs::for('mypage', function ($trail) {
    $trail->parent('top');
    $trail->push('マイページ', route('mypage'));
});

// 利用規約
Breadcrumbs::for('terms', function ($trail) {
    $trail->parent('top');
    $trail->push('利用規約', route('terms'));
});

// プライバシーポリシー
Breadcrumbs::for('privacy', function ($trail) {
    $trail->parent('top');
    $trail->push('プライバシーポリシー', route('privacy'));
});

// 運営者情報
Breadcrumbs::for('company', function ($trail) {
    $trail->parent('top');
    $trail->push('運営者情報', route('company'));
});

// お問い合わせ
Breadcrumbs::for('contact.contact', function ($trail) {
    $trail->parent('top');
    $trail->push('お問い合わせ', route('contact.contact'));
});

Breadcrumbs::for('contact.finish', function ($trail) {
    $trail->parent('top');
    $trail->push('お問い合わせ', route('contact.contact'));
});

// ログイン
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('top');
    $trail->push('ログイン', route('login'));
});

// 新規ユーザー登録
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('top');
    $trail->push('新規登録', route('register'));
});

// 新規登録
Breadcrumbs::for('register.diamond', function ($trail) {
    $trail->parent('top');
    $trail->push('新規登録', route('register.diamond'));
});

// パスワード再設定手続き
Breadcrumbs::for('password.request', function ($trail) {
    $trail->parent('top');
    $trail->push('パスワード再設定手続き', route('password.request'));
});

// パスワードの再設定
Breadcrumbs::for('password.reset', function ($trail) {
    $trail->parent('top');
    $trail->push('パスワードの再設定');
});

// パスワードの変更
Breadcrumbs::for('user.change_password', function ($trail) {
    $trail->parent('mypage');
    $trail->push('パスワードの変更');
});

// メールアドレスの変更
Breadcrumbs::for('user.change_email', function ($trail) {
    $trail->parent('mypage');
    $trail->push('メールアドレスの変更');
});

// クレジットカード決済
Breadcrumbs::for('user.upgrade', function ($trail) {
    $trail->parent('top');
    $trail->push('クレジットカード決済');
});

// アフィリエイト
Breadcrumbs::for('affiliate', function ($trail) {
    $trail->parent('top');
    $trail->push('アフィリエイト', route('affiliate'));
});

// レッスン一覧
Breadcrumbs::for('lesson', function ($trail) {
    if (!empty(Auth::user())) {
        $trail->parent('mypage');
    } else {
        $trail->parent('top');
    }
    $trail->push('レッスン一覧', route('lesson'));
});

// レッスン一覧
Breadcrumbs::for('lesson.detail', function ($trail, $name) {
    $trail->parent('lesson');
    $trail->push($name, route('lesson'));
});

// レッスン詳細
Breadcrumbs::for('lesson_detail', function ($trail, $lesson_detail, $text) {
    if (!empty(Auth::user())) {
        $trail->parent('mypage');
    } else {
        $trail->parent('top');
    }
    $trail->push('レッスン一覧', route('lesson'), ['enable_link' => true]);
    $trail->push($text, route('lesson.detail', ['lesson_detail' => $lesson_detail['lesson_id']]), ['enable_link' => true]);
});
