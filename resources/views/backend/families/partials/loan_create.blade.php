@php
    $max_loan = (int)$sum* (int)$loan_factor;
    $pay_count = $max_loan/ (int)$min_loan_pay;

    $now = jdate();
    if($now->getDay() > (int)$loan_pay_day){
        $date = $now->addMonths(2);
    }else{
        $date = $now->addMonths(1);
    }

    $months = [];
    for($i=1; $i<=12; $i++)
        $months[$i] = $i;
@endphp

@component('forms.panel', ['title'=>'اختصاص وام'])

@if($sum<$min_accounts)
موجودی حساب این گروه برای دریافت وام کافی نمی باشد
    @else
    <form action="{{route('loans.create', [$family->id])}}" method="post">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-8 col-xs-8 col-md-offset-2">
                <div class="form-group text-red">
                    <span>حداکثر مقدار مجاز وام: {{ $max_loan}}</span>
                </div>
                @component('forms.input', [
                    'name'=>'amount',
                    'label'=>'مقدار وام اخصاص یافته',
                    'value'=>$max_loan
                    ])
                @endcomponent
                @component('forms.input', [
                    'name'=>'min_pay_day',
                    'label'=>'قسط ماهیانه',
                    'value'=>$min_loan_pay
                    ])
                @endcomponent

                <label>تاریخ اولین قسط</label>
                <div class="row">
                    <div class="col-md-3">
                        @component('forms.input', [
                            'name'=>'start_date_day_1',
                            'label'=>'روز',
                            'value'=>$loan_pay_day
                            ])
                        @endcomponent
                    </div>
                    <div class="col-md-3">
                        @component('forms.select', [
                            'name'=>'start_date_month_1',
                            'label'=>'ماه',
                            'options'=>$months,
                            'selected'=> $date->getMonth()
                            ])
                        @endcomponent
                    </div>
                    <div class="col-md-3">
                        @component('forms.input', [
                            'name'=>'start_date_year_1',
                            'label'=>'سال',
                            'value'=> $date->getYear()
                            ])
                        @endcomponent
                    </div>
                    <div class="col-md-3">
                        @component('forms.input', [
                            'name'=>'pay_amount_1',
                            'label'=>'قسط ماهیانه',
                            'value'=> $min_loan_pay,
                            'options'=>['readonly'=>true]
                            ])
                        @endcomponent
                    </div>
                </div>
                @for($i=2;$i<=$pay_count;$i++)
                    @php($new_date = $date->addMonths($i-1))
                    <div class="row">
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'start_date_day_'.$i,
                                'label'=>'روز',
                                'value'=>$loan_pay_day,
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.select', [
                                'name'=>'start_date_month_'.$i,
                                'label'=>'ماه',
                                'options'=>$months,
                                'selected'=> $new_date->getMonth(),
                                'readonly'=>true
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'start_date_year_'.$i,
                                'label'=>'سال',
                                'value'=> $new_date->getYear(),
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'pay_amount_'.$i,
                                'label'=>'قسط ماهیانه',
                                'value'=> $min_loan_pay,
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                    </div>
                @endfor
                @if(($max_loan % (int)$min_loan_pay)>0)
                    @php($new_date = $date->addMonths((int)$pay_count))
                    @php($pay_count = (int)$pay_count)
                    <div class="row">
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'start_date_day_'.$pay_count,
                                'label'=>'روز',
                                'value'=>$loan_pay_day,
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.select', [
                                'name'=>'start_date_month_'.$pay_count,
                                'label'=>'ماه',
                                'options'=>$months,
                                'selected'=> $new_date->getMonth(),
                                'readonly'=>true
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'start_date_year_'.$pay_count,
                                'label'=>'سال',
                                'value'=> $new_date->getYear(),
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'pay_amount_'.$pay_count,
                                'label'=>'قسط ماهیانه',
                                'value'=> $max_loan % (int)$min_loan_pay,
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">ایجاد وام</button>
            </div>
        </div>
    </form>

@endif

@endcomponent
