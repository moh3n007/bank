@component('forms.panel', ['title'=>'لیست اعضاء'])

    <div style="background-color: #e8e8e8;border-radius: 3px;height: 50px; padding-top: 9px">
            <form action="#" method="POST">
                <div class="form-group col-md-11">
                    <select name="family_id" id="family_id" class="form-control">
                        @foreach($names as $name)
                            <option value="{{ $name->family_id }}">{{ $name->user->fullname()}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 text-center ">
                    <button type="submit" class="btn btn-primary pull-left">اضافه</button>
                </div>
            </form>
    </div>
    <br><br>

    <hr>

    <table class="table table-responsive table-striped">
        <tr>
            <th>#</th>
            <th>نام و نام خانوادگی</th>
            <th>شماره حساب</th>
            <th>تاریخ ایجاد</th>
            <th></th>
        </tr>
        @foreach($accounts as $account)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td class="text-center">{{ @$account->user->fullname()}}</td>
                <td class="text-center">{{ $account->account_number }}</td>
                <td class="text-center">{{ jdate($account->created_at)->format('%d %B، %Y') }}</td>
                <td class="setting-icons text-center col-xs-1">
                    <a href="{{ route('accounts.show' , [$account->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                        <i class="fa fa-info"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>

@endcomponent