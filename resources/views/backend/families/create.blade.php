@php
    $crumbs = [
        ['name'=> 'لیست گروه ها', 'url'=> route('families.list')],
        ['name'=> 'ثبت گروه', 'url'=> '#'],
    ]
@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'ثبت گروه جدید'])
        <form action="{{route('families.store')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    @component('forms.input', [
                        'name'=>'name',
                        'label'=>'نام گروه',
                        'required'=>true,
                    ])
                    @endcomponent
                    <div class="form-group">
                        <label for="head_id">نماینده گروه</label>
                        <select name="head_id" id="head_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت گروه </button>
                </div>
            </div>
        </form>
    @endcomponent

@endsection
