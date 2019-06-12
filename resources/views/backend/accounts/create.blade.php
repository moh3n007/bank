@php
    $crumbs = [
        ['name'=> 'لیست حساب ها', 'url'=> route('accounts.list')],
        ['name'=> 'ثبت حساب', 'url'=> '#'],
    ]
@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'ثبت حساب جدید'])
        <form action="{{route('accounts.store')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <div class="form-group">
                        <label for="user_list">نام دارنده حساب</label>
                        <select name="user_id" id="user_list" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="family_id">نام گروه</label>
                        <select name="family_id" id="family_id" class="form-control">
                            @foreach($families as $family)
                                <option value="{{ $family->id }}">{{ $family->name }}</option>
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

@section('script')
    <script src="{{ asset('admin\bower_components\select2\dist\js\select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#user_list').select2();
        })
    </script>
@endsection
