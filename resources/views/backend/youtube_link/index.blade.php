@extends('backend.layout.master')
@section('title', 'Youtubeリンク')
@section('content')
    @section('list_header')
        <div class="row">
            <div class="col-sm-12">
                <div id="dataTable_filter" class="dataTables_filter">
                    <label>
                        <a class="btn btn-primary btn-sm" href="{{ route('backend.youtube_link.create') }}">新規</a>
                    </label>
                </div>
            </div>
        </div>
    @stop

    @php
        $table = [
            'title' => 'Youtubeリンク',
            'header' => [
                'Video名',
                '公開状況',
                '表示',
                '',
            ],
            'body' => [
                'name' => [
                    'field' => 'name',
                ],
                'mode' => [
                    'field' => 'mode',
                    'option' => $form['mode'],
                    'attr' => [
                        'style' => 'width:10%',
                        'class' => 'text-center'
                    ]
                ],
                'type' => [
                    'field' => 'type',
                    'option' => $form['type'],
                    'attr' => [
                        'style' => 'width:15%',
                        'class' => 'text-center'
                    ]
                ],
                'button' => [
                    'field' => '',
                    'tpl' => '
                        <a class="btn btn-info btn-sm" href="' . route('backend.youtube_link.edit', ['youtube_link_id' => ':id']) . '">編集</a>
                        <a href="' . route('backend.youtube_link.delete', ['youtube_link_id' => ':id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'削除してよろしいですか？\');">削除</a>
                    ',
                    'tpl_arg' => [
                        ':id' => 'id'
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
