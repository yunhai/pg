@extends('backend.layout.master')
@section('title', 'レッスン一覧')
@section('content')
    @section('list_header')
        <div class="row">
            <div class="col-sm-12">
                <div id="dataTable_filter" class="dataTables_filter">
                    <label>
                        <a class="btn btn-primary btn-sm" href="{{ route('backend.lesson.create') }}">新規</a>
                    </label>
                </div>
            </div>
        </div>
    @stop

    @php
        $table = [
            'title' => 'カテゴリー',
            'header' => [
                'レッスン一名',
                'カテゴリー',
                '動画',
                '',
            ],
            'body' => [
                'name' => [
                    'field' => 'name',
                ],
                'category' => [
                    'field' => 'category_id',
                    'option' => $form['category'],
                    'attr' => [
                        'style' => 'width:15%',
                    ]
                ],
                'video_count' => [
                    'field' => 'video_count',
                    'attr' => [
                        'style' => 'width:6%',
                        'class' => 'text-center'
                    ]
                ],
                'button' => [
                    'field' => '',
                    'tpl' => '
                        <a class="btn btn-info btn-sm" href="' . route('backend.lesson_detail.index', ['lesson_id' => ':id']) . '">動画</a>
                        <a class="btn btn-info btn-sm" href="' . route('backend.lesson.edit', ['lesson_id' => ':id']) . '">編集</a>
                        <a href="' . route('backend.lesson.delete', ['lesson_id' => ':id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'削除してよろしいですか？\');">削除</a>
                    ',
                    'tpl_arg' => [
                        ':id' => 'id'
                    ],
                    'attr' => [
                        'style' => 'width:20%',
                        'class' => 'text-center'
                    ]
                ]
            ],
        ];
    @endphp
    @include('backend.component.list.paging', ['table' => $table, 'data' => $lessons])
@stop
