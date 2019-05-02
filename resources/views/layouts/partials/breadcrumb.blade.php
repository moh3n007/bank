<ol class="breadcrumb">
    <li><a href="{{url('panel')}}"><i class="fa fa-dashboard"></i>{{__('first_page')}}</a></li>
    @if(isset($crumbs))
        @foreach($crumbs as $crumb)
            <li><a href="{{url($crumb['url'])}}">{{$crumb['name']}}</a></li>
        @endforeach
    @endif
</ol>