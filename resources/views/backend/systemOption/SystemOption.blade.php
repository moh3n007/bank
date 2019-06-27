@php
    $crumbs = [
        ['name'=> 'تنظیمات', 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'تنظیمات'])
        <div class="row">
            <div class="col-md-8 col-lg-offset-2">
                @foreach($options as $option)
                    <form action="{{ route('systemOption.edit' , [$option->id]) }}" method="Post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="{{$option->name}}">{{ $option->f_name }}</label>
                            <div class="input-group input-group-sm">
                                <input name="{{$option->name}}" id="{{$option->name}}" class="form-control" value="{{ $option->value }}"/>
                                <span class="input-group-btn">
                                  <button class="btn btn-info btn-flat">تایید</button>
                                </span>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    @endcomponent

@endsection