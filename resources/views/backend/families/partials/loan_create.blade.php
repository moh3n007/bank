@php
    $max_loan = isset($max_loan) ? $max_loan : (int)$sum * (int)$loan_factor;
    $pay_count = $max_loan / (int)$min_loan_pay;

    $now = isset($pay_date_1) ? $pay_date_1->subMonths(1) : jdate();
    if($now->getDay() > (int)$loan_pay_day){
        $date = $now->addMonths(2);
    }else{
        $date = $now->addMonths(1);
    }

    $months = [];
    for($i=1; $i<=12; $i++)
        $months[$i] = $i;

    $accounts = \App\Models\Account::sum('amount');
    $intervals = \App\Models\Interval::whereNotNull('pay_date')->sum('amount');
    $loans = \App\Models\Loan::sum('amount');
    $payments = \App\Models\Payment::whereNotNull('pay_date')->sum('amount');
    $fullAmount = $accounts + $intervals + $payments - $loans;
    if ($max_loan<=$fullAmount) {$loan_amount = $max_loan;} else {$loan_amount = $fullAmount;}
@endphp

@component('forms.panel', ['title'=>'اختصاص وام'])

    @if($sum<$min_accounts)
        <span style="color: red">موجودی حساب این گروه برای دریافت وام کافی نمی باشد</span>

    @else
    <form action="{{route('loans.create', [$family->id])}}" method="post" id="loan_form">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-8 col-xs-8 col-md-offset-2">
                <div class="form-group text-red">
                    <span class="col-md-6">حداکثر مقدار مجاز وام: {{ (int)$sum* (int)$loan_factor}}</span>
                    <span class="col-md-6">حداقل مقدار قسط ماهیانه: {{ (int)$min_loan_pay}}</span>
                </div><br>
                @component('forms.input', [
                    'name'=>'amount',
                    'label'=>'مقدار وام اخصاص یافته',
                    'value'=>$loan_amount
                    ])
                @endcomponent
                @component('forms.input', [
                    'name'=>'min_loan_pay',
                    'label'=>'قسط ماهیانه',
                    'value'=>$min_loan_pay
                    ])
                @endcomponent
                <br>
                <hr>
                <br>
                <label style="color: red">تاریخ اولین قسط</label>
                <div class="row" style="color: red">
                    <div class="col-md-3">
                        @component('forms.input', [
                            'name'=>'pay_date_day_1',
                            'label'=>'روز',
                            'value'=>$loan_pay_day
                            ])
                        @endcomponent
                    </div>
                    <div class="col-md-3">
                        @component('forms.select', [
                            'name'=>'pay_date_month_1',
                            'label'=>'ماه',
                            'options'=>$months,
                            'selected'=> $date->getMonth()
                            ])
                        @endcomponent
                    </div>
                    <div class="col-md-3">
                        @component('forms.input', [
                            'name'=>'pay_date_year_1',
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
                                'name'=>'pay_date_day_'.$i,
                                'label'=>'روز',
                                'value'=>$loan_pay_day,
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.select', [
                                'name'=>'pay_date_month_'.$i,
                                'label'=>'ماه',
                                'options'=>$months,
                                'selected'=> $new_date->getMonth(),
                                'readonly'=>true
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'pay_date_year_'.$i,
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
                    @php($pay_count++)
                    <div class="row">
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'pay_date_day_'.$pay_count,
                                'label'=>'روز',
                                'value'=>$loan_pay_day,
                                'options'=>['readonly'=>true]
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.select', [
                                'name'=>'pay_date_month_'.$pay_count,
                                'label'=>'ماه',
                                'options'=>$months,
                                'selected'=> $new_date->getMonth(),
                                'readonly'=>true
                                ])
                            @endcomponent
                        </div>
                        <div class="col-md-3">
                            @component('forms.input', [
                                'name'=>'pay_date_year_'.$pay_count,
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
                <br>
                <button type="button" class="btn btn-primary" id="reload">محاسبه مجدد</button>
                <button type="submit" class="btn btn-success" name="create">ایجاد وام</button>
            </div>
        </div>
    </form>

@endif

@endcomponent
@push('script')
<script>
    $(document).ready(function () {
        $('#reload').click(function () {
            var form = $('#loan_form');
            form.attr('action','{{route('families.show', [$family->id])}}');
            form.submit();
        });
    });
</script>
@endpush
