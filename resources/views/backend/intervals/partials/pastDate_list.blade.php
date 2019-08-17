@component('forms.panel', ['title'=>'لیست پرداختی معوقه'])

    <form action="#" method="post">
        {{ csrf_field() }}
        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>نام گروه</th>
                <th>مبلغ پرداختی</th>
                <th>تاریخ پرداخت</th>
                <th><input type="checkbox" id="check_all" /></th>
            </tr>

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