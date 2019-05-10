@php
    $label = $label ?? '';
    $value = old($name)?? ($value?? '');
    $palceholder = $value == '' ? $label : '';
    $id = $id ?? trim($name, '[]');
    $required = $required ?? false;
    $error = isset($errors) && $errors->has($name)? $errors->first($name) : null;
    $type = $type ?? 'text';
    $class = $class ?? '';
    $readonly = @$readonly? 'readonly' : '';
    $options = $options ?? [];
    $option_str = '';
    foreach ($options as $key=>$val)
        $option_str .= $key.'='.$val.' ';
@endphp

@component('forms.basic-form', [
	'label'=> $label,
	'error'=> $error,
	'required'=> $required,
	'id'=> $id
	])
    <input type="{{$type}}" class="form-control {{$class}}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $palceholder }}" value="{{$value}}" {{$required ? 'required' : ''}} {{$readonly}} {{$option_str}}/>
@endcomponent