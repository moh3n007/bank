@php
    $crumbs = [
        ['name'=> 'لیست حساب ها', 'url'=> route('accounts.list')],
        ['name' => @$account->user->fullname() , 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'نمایش کامل حساب'])
        <form action="{{ route('accounts.update' , [$account->id]) }}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <div class="form-group">
                        <label for="user_list">نام دارنده حساب</label>
                        <div name="user_id" id="user_list" class="form-control" disabled>
                                {{ @$account->user->fullname() }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="family_id">نام گروه</label>
                        <div name="family_id" id="family_list" class="form-control" disabled>
                            {{ @$account->family->name }}
                        </div>
                    </div>
                    @component('forms.input', [
                        'name'=>'account_number',
                        'label'=>'شماره حساب',
                        'required'=>true,
                        'type'=>'integer',
                        'value'=>$account->account_number
                    ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'amount',
                        'label'=>'موجودی اولیه حساب',
                        'required'=>true,
                        'type'=>'integer',
                        'value'=>$account->amount
                    ])
                    @endcomponent
                    <button type="submit" class="btn btn-primary">تغییر حساب </button>
                </div>
            </div>
        </form>
    @endcomponent
@endsection

