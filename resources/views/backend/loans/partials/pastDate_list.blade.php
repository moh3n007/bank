@component('forms.panel', ['title'=>'لیست اقساط معوقه'])

    <form action="{{ route('loans.pay') }}" method="post">
        {{ csrf_field() }}
        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>نام گروه</th>
                <th>مبلغ قسط</th>
                <th>سررسید قسط</th>
                <th><input type="checkbox" id="check_all" /></th>
            </tr>
            @foreach($pastDates as $pastDate)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center">{{ @$pastDate->loan->family->name }}</td>
                    <td class="text-center">{{ @$pastDate->amount }}</td>
                    <td class="text-center" style="color: red">{{ jdate(@$pastDate->due_date)->format('%d, %B، %Y') }}</td>
                    <td class="setting-icons text-center col-xs-1">
                        <input type="checkbox" name="{{$pastDate->id}}" id="checkbox" {{ $pastDate->pay_date ? 'checked disabled="disabled"' : '' }}>
                    </td>
                </tr>
            @endforeach
        </table>
        <br>
        <hr>
        <button type="submit" class="btn btn-primary">پرداخت قسط</button>
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