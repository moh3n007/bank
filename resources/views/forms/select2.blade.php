@php
	$include_assets = $include_assets?? true;
	$label = $label?? 'انتخاب کنید';
	$palceholder = $palceholder?? __('search');
	$name = $name?? 'select2';
	$value = old($name)?? ($value?? '');
	$id = $id?? trim($name, '[]');
	$required = $required?? true;
	$error = isset($errors) && $errors->has($name)? $errors->first($name) : null;
	$multiple = isset($multiple) && $multiple ? 'true' : 'false';
@endphp

@component('backend.form.group', [
	'label'=> $label,
	'error'=> $error,
	'required'=> $required,
	'class'=> 'text-right'
	])
	<select class='form-control select2'
		name="{{ $name }}"
		id="{{ $id }}"
		style="width: 100%"
		data-placeholder="{{ $palceholder }}" >
	</select>
@endcomponent

@push('style')
	@if($include_assets)
		<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
	@endif
@endpush

@push('script')
	@if($include_assets)
		<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	@endif
	<script>
		$(function () {
            $('#{{ $id }}').select2(
						@if(isset($ajaxUrl))
                {
                    minimumInputLength: 3,
                    ajax: {
                        url: "{{ $ajaxUrl }}"
                    },
                    multiple: {{ $multiple }}
                }
			@endif
		);
        })

	</script>
@endpush