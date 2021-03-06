@extends('backend.layout.master')
@section('title', 'お知らせ')
@php
    $target = $target ?? [];
    $form = [
        'form_btn' => '保存',
        'form_label' => 'お知らせ',
        'form_back_url' => route('backend.announcement.index'),
        'form_field' => [
            'content' => [
                'field_label' => '内容',
                'field_name' => 'content',
                'field_value' => array_get($target, 'content', ''),
                'field_type' => 'textarea'
            ],
        ],
        'form_attribute' => [
        ]
    ];
@endphp
@section('content')
    @include('backend.component.form.form', $form)
@stop
