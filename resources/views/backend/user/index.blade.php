@extends('backend.layout.master')
@section('title', 'ユーザー')

@section('content')
    @section('list_header')
        <div class='statis'>
            <label>無料人数: </label>
            <span>{{ $statis['member_normal'] }}</span><br />
            <label>有料人数: </label>
            <span>{{ $statis['member_diamond'] }}</span>
        </div>
        @include('backend.component.filter.user.user', $filter_form ?? [])
    @stop
    @php
        $table = [
            'title' => 'カテゴリー',
            'header' => [
                'ユーザー名',
                'メールアドレス',
                '状況',
                '会員',
                '登録日',
                '',
            ],
            'body' => [
                'name' => [
                    'field' => 'name',
                ],
                'email' => [
                    'field' => 'email',
                    'attr' => [
                        'style' => 'width:25%',
                    ]
                ],
                'mode' => [
                    'field' => 'mode',
                    'option' => $form['mode'],
                ],
                'grade' => [
                    'field' => 'grade',
                    'option' => $form['grade'],
                ],
                'created_at' => [
                    'field' => 'created_at',
                ],
                'button' => [
                    'field' => '',
                    'tpl' => '
                        <a class="btn btn-info btn-sm" href="' . route('backend.user.edit', ['user_id' => ':id']) . '">編集</a>
                        <a class="btn btn-secondary btn-sm" href="' . route('backend.user.change_password', ['user_id' => ':id']) . '">パスワード変更</a>
                        <a class="btn btn-warning btn-sm j-mode:mode0" href="' . route('backend.user.block', ['user_id' => ':id']) . '" onclick="return confirm(\'停止してよろしいでしょうか？\');">停止</a>
                        <a class="btn btn-success btn-sm j-mode:mode1" href="' . route('backend.user.unblock', ['user_id' => ':id']) . '" onclick="return confirm(\'開始してよろしいでしょうか？\');">開始</a>
                        <a class="btn btn-danger btn-sm" href="' . route('backend.user.delete', ['user_id' => ':id']) . '" onclick="return confirm(\'削除してよろしいですか？\');">削除</a>
                    ',
                    'tpl_arg' => [
                        ':id' => 'id',
                        ':mode' => 'mode',
                    ],
                    'attr' => [
                        'style' => 'width:15%',
                        'class' => 'text-center'
                    ]
                ]
            ],
        ];
    @endphp
    @include('backend.component.list.paging', ['table' => $table, 'data' => $data])
@stop
