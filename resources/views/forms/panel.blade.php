@php
    $title = $title ?? '';
@endphp
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{$title}}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        {{$slot}}
    </div>
    <!-- /.box-body -->
    {{--<div class="box-footer">

    </div>--}}
    <!-- /.box-footer-->
</div>