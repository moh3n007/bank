@php
    $class = $class ?? '';
    $class .= !empty($error) ? ' has-danger' : '';
    $reqAttribute = $required ? 'required' : '';
    $reqStar = $required ? '*' : '';
    $id = $id ?? ''
@endphp
<div class="form-group {{ $class }}" {{ $reqAttribute }}>
    <label class="form-control-label" for="{{$id}}"> {{ $label }} <span style="font-size: 80%" class="text-warning">{{ $reqStar }}</span></label>
    {{ $slot }}
    @if( !empty($error) )
        <span class="form-control-feedback">
			{{ $error }}
		</span>
    @endif
</div>