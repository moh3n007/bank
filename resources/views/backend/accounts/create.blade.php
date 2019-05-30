@php
    $crumbs = [
        ['name'=> 'لیست حساب ها', 'url'=> route('accounts.list')],
        ['name'=> 'ثبت حساب', 'url'=> '#'],
    ]
@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'ثبت حساب جدید'])
        <form action="{{route('accounts.create')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <div class="form-group">
                        <label for="user_list">نام دارنده حساب</label>
                        <select name="user_list" id="user_list" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                            @endforeach
                        </select>
                    </div>
                    @component('forms.input', [
                        'name'=>'account_number',
                        'label'=>'شماره حساب',
                        'required'=>true,
                        'type'=>'integer'
                    ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'amount',
                        'label'=>'موجودی اولیه حساب',
                        'required'=>true,
                        'type'=>'integer'
                    ])
                    @endcomponent
                    <button type="submit" class="btn btn-primary">ثبت حساب </button>
                </div>
            </div>
        </form>
    @endcomponent

@endsection
