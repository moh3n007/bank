<ol class="breadcrumb">
    <li><a href="{{url('panel')}}"><i class="fa fa-home"></i>خانه</a></li>
    @foreach($crumbs as $crumb)
        <li><a href="{{url($crumb['url'])}}">{{$crumb['name']}}</a></li>
    @endforeach
</ol>