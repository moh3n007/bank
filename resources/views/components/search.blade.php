@php
    $action = $action ?? ''
@endphp

<div>
    <form action="{{ $action }}" class="navbar-form navbar-left col-md-12"  method="get" accept-charset="utf-8">
        <div class="form-group">
            <input name="search_term" value="{{ \Illuminate\Support\Facades\Input::get('search_term') }}" type="text" class="form-control input-sm" placeholder="جستجو">
        </div>
        <div class="btn-group btn-group-sm">
            <button style="margin-left: 0;" type="submit" class="btn btn-sm btn-info" title="جستجو" data-toggle="tooltip"><span class="fa fa-search"></span></button>
            <button type="button" onclick="$('input[name=search_term]').val(''); $(this).parents('form:first').submit();" class="btn btn-sm btn-primary" data-toggle="tooltip" title="پاک سازی جستجو"><span class="fa fa-times"></span></button>
        </div>
    </form>
</div>