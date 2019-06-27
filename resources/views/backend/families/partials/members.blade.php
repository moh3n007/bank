@component('forms.panel', ['title'=>'لیست اعضاء'])

    <div style="background-color: #e8e8e8;border-radius: 3px;height: 50px; padding-top: 9px">
        <form action="{{route('families.addAccount', [$family->id])}}" method="POST">
            {{csrf_field()}}
            <div class="form-group col-md-11">
                <div class="form-group">
                    <select name="account_id" id="account_id" class="form-control select2" style="width: 100%;">
                        @foreach($accounts as $account)
                            <option value="{{ $account['id'] }}">{{ $account['name']}}</option>
                        @endforeach
                    </select>
                </div>
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
            <th>نماینده گروه</th>
            <th></th>
        </tr>
        @foreach($family->accounts as $account)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td class="text-center">{{ @$account->user->fullname()}}</td>
                <td class="text-center">{{ $account->account_number }}</td>
                <td class="text-center">{{ jdate($account->created_at)->format('%d %B، %Y') }}</td>
                <td class="text-center">
                    @if($account->user->id == $family->head_id)
                        <a href="#">
                            <i class="fa fa-star"></i>
                        </a>
                    @else
                        <a href="{{route('families.setHead', [$family->id, $account->user->id])}}">
                            <i class="fa fa-star-o"></i>
                        </a>
                    @endif
                </td>
                <td class="setting-icons text-center col-xs-1">
                    <a href="{{ route('accounts.show' , [$account->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                        <i class="fa fa-info"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>

@endcomponent
