@component('forms.panel', ['title'=>'حساب کاربر'])

    <div class="col-md-12">
        <div class="box-header with-border">
            <div class="clear"></div>
            <div class="well">
                <div class="row">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>شماره حساب</th>
                            <th>گروه</th>
                            <th>نمایش حساب</th>
                        </tr>
                        @foreach($accounts as $account)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td class="text-center">{{ @$account->account_number }}</td>
                                <td class="text-center">{{@$account->family->name}}</td>
                                <td class="setting-icons text-center">
                                    <div class="btn-group btn-group-xs">

                                        <a href="{{ route('accounts.show' , [$account->id]) }}" class="btn btn-xs btn-primary">نمایش  <span class="fa fa-external-link"></span></a>
                                    </div>
                                    {{--<a href="#" class="btn btn-xs btn-primary">--}}
                                        {{--<i class="fa fa-info">نمایش</i>--}}
                                    {{--</a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endcomponent