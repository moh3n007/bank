<ol class="breadcrumb col-md-12">
    <li><a href="{{url('home')}}"><i class="fa fa-home"></i>خانه</a></li>
    @foreach($crumbs as $crumb)
        <li><a href="{{url($crumb['url'])}}">{{$crumb['name']}}</a></li>
    @endforeach
    <span class="pull-left col-md-2">امروز : {{ jdate()->format('%d , %B ، %Y') }}</span>
</ol>
