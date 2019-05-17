@php
    $label = $label ?? '';
    $value = old($name)?? ($value?? '');
    $palceholder = $value == '' ? $label : '';
    $id = $id ?? trim($name, '[]');
    $required = $required ?? false;
    $error = isset($errors) && $errors->has($name)? $errors->first($name) : null;
    $class = $class ?? '';
    $readonly = @$readonly? 'readonly' : '';
    $options = $options ?? [];
    $option_str = '';
    foreach ($options as $key=>$val)
        $option_str .= $key.'='.$val.' ';
@endphp

@component('forms.basic-form', [
    'name'=> $name,
	'label'=> $label,
	'error'=> $error,
	'required'=> $required,
	'id'=> $id
	])
    <textarea class="form-control {{$class}}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $palceholder }}" {{$required ? 'required' : ''}} {{$readonly}} {{$option_str}}>{{ $value }}</textarea>
@endcomponent