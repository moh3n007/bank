<ol class="breadcrumb">
    <li><a href="{{url('home')}}"><i class="fa fa-home"></i>خانه</a></li>
    @foreach($crumbs as $crumb)
        <li><a href="{{url($crumb['url'])}}">{{$crumb['name']}}</a></li>
    @endforeach
</ol>