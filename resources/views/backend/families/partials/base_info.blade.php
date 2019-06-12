@component('forms.panel', ['title'=>'نمایش اطلاعات کامل'])


    <form action="{{ route('families.update' ,[$family->id]) }}" method="POST">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-8 col-xs-8">
                @component('forms.input', [
                    'name'=>'name',
                    'label'=>'نام گروه',
                    'required'=>true,
                    'value'=>$family->name
                    ])
                @endcomponent
                <div class="col-md-6 text-center">
                    <dl>
                        <dt>نماینده گروه</dt>
{{--                        <dd style="margin-bottom: 10px">{{ @$family->head->fullname()}}</dd>--}}
                    </dl>
                </div>
            </div>
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-1 col-xs-1" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">ثبت تغییر </button>
            </div>
        </div>
    </form>

@endcomponent