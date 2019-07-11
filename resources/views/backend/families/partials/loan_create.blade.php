@component('forms.panel', ['title'=>'اختصاص وام'])

@if($sum<$min_accounts->value)
موجودی حساب این گروه برای دریافت وام کافی نمی باشد
    @else
    <form action="#" method="get">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-8 col-xs-8 col-md-offset-2">
                <div class="form-group text-red">
                    <span>حداکثر مقدار مجاز وام: {{ $sum*$loan_factor->value }}</span>
                </div>
                @component('forms.input', [
                    'name'=>'amount',
                    'label'=>'مقدار وام اخصاص یافته',
                    'value'=>$sum*$loan_factor->value
                    ])
                @endcomponent
                @component('forms.input', [
                    'name'=>'amount',
                    'label'=>'قسط ماهیانه',
                    'value'=>$min_loan_pay->value
                    ])
                @endcomponent
                @component('forms.input', [
                    'name'=>'strat_date',
                    'label'=>'تاریخ اولین قسط',
                    'value'=>$loan_pay_day->value
                    ])
                @endcomponent
                <button type="submit" class="btn btn-primary">ایجاد وام</button>
            </div>
        </div>
    </form>

@endif

@endcomponent
