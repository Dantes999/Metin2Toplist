<div class="row justify-content-center">
    <div class="d-flex justify-content-center">
        <div class="card m-2" style="width: 50rem;">
            <div class="card-header" style="display:flex;justify-content: space-between;">
                <span>#{{ $index+1 }} {{ $server['name'] }}</span>
                <span>Max Level: {{$server['level']}}</span>
                <span>Class: {{$server['class']}}</span>
                <span>
                    @foreach(explode('|',$server['lang']) as $lang)
                        <i class="flag-icon flag-icon-{{trim($lang)}}"></i>
                    @endforeach
                </span>
                <span><img src="images/check_icon.png" height="20">{{ $server['votesCount'] }}</span>
            </div>
            <div class="card-body cut-text" style="display: flex; flex-direction: column; align-items: center;height: 280px">
                <p>
                    <a target="_blank" href="{{ $server['url'] }}">
                        <img src="banners/{{$server['banner']}}"
                             style="width: 100%;max-width: 500px; max-height: 200px;">
                    </a>
                </p>
                <p>{{ $server['desc'] }}</p>
            </div>
        </div>
    </div>
</div>

