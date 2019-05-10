@php
	$include_assets = $include_assets?? true;
	$label = $label?? 'ویرایشگر';
	$name = $name?? 'editor';
	$value = old($name)?? ($value?? '');
	$id = $id?? $name;
	$required = $required?? true;
	$error = isset($errors) && $errors->has($name)? $errors->first($name) : null;
@endphp

@component('backend.form.group', ['label'=> $label, 'error'=> $error, 'required'=> $required])
	<textarea id="{{ $id }}" name="{{ $name }}" class="form-control">
		{{ $value }}
	</textarea>
@endcomponent

@push('script')
	@if($include_assets)
		<script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
	@endif
	<script>
		$(function() {
			CKEDITOR.replace('{{ $id }}')
		})
	</script>
@endpush