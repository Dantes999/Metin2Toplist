@extends('welcome')

@section('content')
    <div style="min-height: 100%">
        @isset($servers)
            @foreach($servers as $index=>$server)
                <x-server-detail :server="$server" :index="$index"></x-server-detail>
            @endforeach
        @endisset
    </div>
@endsection
