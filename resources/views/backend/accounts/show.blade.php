@php
    $crumbs = [
        ['name'=> 'لیست حساب ها', 'url'=> 'accounts.list'],
        ['name' => $account->id , 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست اعضاء'])

    @endcomponent
@endsection

