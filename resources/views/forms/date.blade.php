@php
	$include_assets = $include_assets?? true;
	$label = $label?? 'تاریخ';
	$name = $name?? 'date';
	$id = $id?? $name;
	$value = old($name)?? ($value?? '');
	$required = $required?? true;
	$error = isset($errors) && $errors->has($name)? $errors->first($name) : null;
	$time = $time?? false;
@endphp

@component('backend.form.group', ['label'=> $label, 'error'=> $error, 'required'=> $required])
	<div class="input-group date-picker">
		<span class="input-group-addon" id="{{$id}}-btn"><i class="fa fa-calendar-plus-o text-info"></i></span>
		<input type="text" class="form-control" id="{{ $id }}" disabled placeholder="{{$label}}" aria-label="{{$id}}-btn" aria-describedby="{{$id}}-btn">
		<input type="hidden" name="{{ $name }}" value="{{ $value }}" id="{{ $id }}-1" aria-label="{{$id}}-btn" aria-describedby="{{$id}}-btn">
	</div>
@endcomponent

@push('style')
@if($include_assets)
	<link rel="stylesheet" href="{{asset('admin/bower_components/BootstrapPersianDateTimePicker/dist/jquery.md.bootstrap.datetimepicker.style.css')}}">
@endif
@endpush

@push('script')
@if($include_assets)
	<script src="{{ asset('admin/bower_components/BootstrapPersianDateTimePicker/dist/jquery.md.bootstrap.datetimepicker.js') }}"></script>
@endif
<script>
    $(document).ready(function() {
        $('#{{ $id }}-btn').MdPersianDateTimePicker({
            targetTextSelector: '#{{ $id }}',
            targetDateSelector: '#{{ $id }}-1',
            dateFormat: 'yyyy-MM-dd HH:mm:ss',
            enableTimePicker: {{$time?'true':'false'}},
        });
    });
</script>
@endpush