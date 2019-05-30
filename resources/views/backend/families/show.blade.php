@php
    $crumbs = [
        ['name'=> 'لیست خانواده ها', 'url'=> 'fimilies.list'],
        ['name' => $family->name , 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست اعضاء'])
        <div class="form-group">
            <select name="user_list" id="user_list" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                @endforeach
            </select>
        </div>
    @endcomponent
@endsection

