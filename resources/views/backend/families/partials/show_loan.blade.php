@component('forms.panel', ['title'=>'لیست وام ها'])

    @if($count_loan == 0)

        <span style="color: red">وامی به این گروه اختصاص داده نشده است</span>

    @else

        <div style="background-color: #e8e8e8;border-radius: 3px;height: 50px; padding-top: 15px; padding-right: 9px">
            <span>تعداد وام های اختصاص یافته:</span>
            <span>{{ $count_loan }}</span>
        </div>
        <br><br>

        <hr>

        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>مقدار وام</th>
                <th>تاریخ شروع</th>
                <th>تاریخ خاتمه</th>
            </tr>
            @foreach($family->loans as $loan)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center">{{ @$loan->amount}}</td>
                    <td class="text-center">{{ jdate($loan->start_date)->format('%d %B، %Y') }}</td>
                    <td class="text-center">{{ jdate($loan->finish_date)->format('%d %B، %Y') }}</td>
                    <td class="setting-icons text-center col-xs-1">
                        <a href="{{ route('loans.show' , $loan->id) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                            <i class="fa fa-info"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

    @endif



@endcomponent
