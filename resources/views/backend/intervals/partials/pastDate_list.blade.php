@php
    $now = jdate();
    $year = (string)$now->getYear();
    $month = str_pad($now->getMonth(),2,0,STR_PAD_LEFT);
    $firstDay = jdate()->fromformat('Y-m-d',"$year-$month-01");
    $lastDay = $firstDay->getNextMonth();
    $emptyIntervals = $pastIntervals->where('pay_date',null)->pluck('pay_date')->all();
@endphp


@component('forms.panel', ['title'=>'لیست پرداختی معوقه'])

    @if($emptyIntervals == null)
        <span style="color: red">اطلاعاتی جهت نمایش وجود ندارد</span>
    @else
    <form action="{{ route('intervals.pay') }}" method="post">
        {{ csrf_field() }}
        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>نام دارنده حساب</th>
                <th>شماره حساب</th>
                <th><input type="checkbox" id="check_all" /></th>
            </tr>
            @foreach($pastIntervals as $pastInterval)
                <tr style="color: red;">
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center">{{ @$pastInterval->account->user->fullname() }}</td>
                    <td class="text-center">{{ @$pastInterval->account->account_number }}</td>
                    {{--<td class="text-center">{{ in_array($account->id, $payedAccountIds->toArray()) ? 'are' : 'na' }}</td>--}}
                    <td class="setting-icons text-center col-xs-1">
                        <input type="checkbox" name="{{$pastInterval->id}}" id="checkbox">
                    </td>
                </tr>
            @endforeach
        </table>
        <br>
        <hr>
        <button type="submit" class="btn btn-primary">ثبت پرداختی</button>
    </form>
    @endif
@endcomponent
@push('script')
<script>
    $(document).ready(function () {
        $('#check_all').click(function() {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    if ($(this).attr('disabled') !== 'disabled')
                        this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    if ($(this).attr('disabled') !== 'disabled')
                        this.checked = false;
                });
            }
        });
    })
</script>
@endpush