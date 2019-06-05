@php
    $crumbs = [
        ['name'=> 'لیست خانواده ها', 'url'=> route('users.list')],
        ['name'=> 'ثبت خانواده', 'url'=> '#'],
    ]
@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'ثبت خانواده جدید'])
        <form action="{{route('families.store')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    @component('forms.input', [
                        'name'=>'name',
                        'label'=>'نام خانواده',
                        'required'=>true,
                    ])
                    @endcomponent
                    <button type="submit" class="btn btn-primary">ثبت خانواده </button>
                </div>
            </div>
        </form>
    @endcomponent

@endsection
