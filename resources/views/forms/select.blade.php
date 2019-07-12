@php
	$label = $label?? 'انتخاب کنید';
	$palceholder = $palceholder?? __('search');
	$name = $name?? 'select2';
	$value = old($name)?? ($value?? '');
	$id = $id?? trim($name, '[]');
	$required = $required?? true;
	$options = $options ?? [];
	$selected = $selected ?? null;
	$readonly = $readonly ?? false;
	$error = isset($errors) && $errors->has($name)? $errors->first($name) : null;
	$multiple = isset($multiple) && $multiple ? 'true' : 'false';
@endphp

@component('forms.basic-form', [
	'name'=> $name,
	'label'=> $label,
	'error'=> $error,
	'required'=> $required,
	'class'=> 'text-right'
	])
	<select class='form-control'
		{{$readonly ? 'readonly' : ''}}
		name="{{ $name }}"
		id="{{ $id }}"
		style="width: 100%"
		data-placeholder="{{ $palceholder }}" >
		<option value="null" disabled selected>انتخاب کنید</option>
		@foreach($options as $key=>$option)
			<option value="{{$key}}" {{ $selected == $key ? 'selected' : '' }}>
				{{ $option }}
			</option>
		@endforeach
	</select>
@endcomponent