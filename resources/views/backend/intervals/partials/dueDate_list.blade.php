@component('forms.panel', ['title'=>'لیست پرداختی جاری'])

    <form action="{{ route('intervals.pay') }}" method="post">
        {{ csrf_field() }}
        <table class="table table-responsive table-striped">
                <tr>
                    <th>#</th>
                    <th>نام دارنده حساب</th>
                    <th>شماره حساب</th>
                    <th>وضعیت پرداخت</th>
                    <th><input type="checkbox" id="check_all" /></th>
                </tr>
                @foreach($accounts as $account)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td class="text-center" id="{{ $account->id }}">{{ $account->user->fullname() }}</td>
                        <td class="text-center">{{ $account->account_number }}</td>
                        <td class="text-center">
                            @if(in_array($account->id , $payedAccountIds->toArray()))
                                <span class="btn btn-success" style="padding:3px;font-size: 11px">پرداخت شد</span>
                            @endif
                        </td>
                        {{--<td class="text-center">{{ in_array($account->id, $payedAccountIds->toArray()) ? 'are' : 'na' }}</td>--}}
                        <td class="setting-icons text-center col-xs-1">
                            <input type="checkbox" name="{{$account->id}}" id="checkbox" {{ in_array($account->id, $payedAccountIds->toArray()) ? 'checked disabled="disabled"' : '' }}>
                        </td>
                    </tr>
                @endforeach
            </table>
            <br>
            <hr>
            <button type="submit" class="btn btn-primary">ثبت پرداختی</button>
    </form>
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