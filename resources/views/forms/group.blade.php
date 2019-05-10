@php
	$class = $class?? '';
	$class .= !empty($error)? ' has-error' : '';
	$reqAttribute = $required? 'required' : '';
	$reqStar = $required? '*' : '';
@endphp
<div class="form-group {{ $class }}" {{ $reqAttribute }}>
<label> {{ $label }} {{ $reqStar }} </label>
	{{ $slot }}
	@if( !empty($error) )
		<span class="help-block">
			{{ $error }}
		</span>
	@endif
</div>