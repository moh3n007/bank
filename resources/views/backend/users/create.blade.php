@extends('layouts.master')

@section('content')

    @component('forms.panel')
        <div class="row">
            <div class="col-md-4">
                @component('forms.input', [
                    'name'=>'f_name',
                    'label'=>'نام'
                ])
                @endcomponent
            </div>
        </div>
    @endcomponent

@endsection
