@php
    $name = $name ?? '';
    $class = $class ?? '';
    $class .= !empty($error) ? ' has-danger' : '';
    $reqAttribute = $required ? 'required' : '';
    $reqStar = $required ? '*' : '';
    $id = $id ?? ''
@endphp
<div class="form-group {{ $class }} {{$errors->has($name)? 'has-error':''}}" {{ $reqAttribute }}>
    <label class="form-control-label" for="{{$id}}"> {{ $label }} <span style="color: #c70e2f;" class="text-warning">{{ $reqStar }}</span></label>
    {{ $slot }}
    @if( !empty($error) )
        <span class="help-block">
			{{ $error }}
		</span>
    @endif
</div>