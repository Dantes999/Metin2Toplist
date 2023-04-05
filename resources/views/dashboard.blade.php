@extends('welcome')

@section('content')
    <div class="container bg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create new Server') }}</div>
                    <div class="card-body">
                        <form action="{{ route('create.server') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="server_name" class="col-md-4 col-form-label text-md-right">
                                    Server Name
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_name" class="form-control" name="server_name" required
                                           autofocus maxlength="100">
                                </div>
                                <label for="server_desc" class="col-md-4 col-form-label text-md-right">
                                    Server Description
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_desc" class="form-control" name="server_desc"
                                           placeholder="Describe your server in short words" maxlength="100">
                                </div>
                                <label for="server_url" class="col-md-4 col-form-label text-md-right">
                                    Server URL
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_url" class="form-control" name="server_url"
                                           placeholder="https://www.YOURSERVER.de" maxlength="50">
                                    <div class="form-text">It is important that you enter the correct url, because the
                                        votes will be verified with this.
                                    </div>
                                </div>
                                <label for="server_level" class="col-md-4 col-form-label text-md-right">
                                    Max Level
                                </label>
                                <div class="col-md-6">
                                    <input type="number" id="server_level" class="form-control" name="server_level"
                                           placeholder="99" maxlength="4">
                                </div>
                                <label for="server_lang" class="col-md-4 col-form-label text-md-right">
                                    Language
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_lang" class="form-control" name="server_lang"
                                           placeholder="de|en" maxlength="40">
                                    <div class="form-text">It is important that you enter the lang like this: en|de|tr|ro <br>
                                         <a target="_blank" href="https://flagicons.lipis.dev/">Short from of the country</a>
                                    </div>
                                </div>
                                <label for="server_class" class="col-md-4 col-form-label text-md-right">
                                    Server Class
                                </label>
                                <div class="col-md-6">
                                    <select name="server_class" class="form-select">
                                        <option selected value="0">Oldschool</option>
                                        <option value="1">Middleschool</option>
                                        <option value="2">Newschool</option>
                                        <option value="3">PvP</option>
                                    </select>
                                </div>
                                <label for="server_banner" class="col-md-4 col-form-label text-md-right">
                                    Server Banner
                                </label>
                                <div class="col-md-6">
                                    <input type="file"
                                           name="server_banner"
                                           id="inputFile"
                                           class="form-control"
                                           accept="image/*">
                                    <div class="form-text">Will be shown as 500x200. Max 8 MB.</div>
                                </div>
                                <script>
                                    $('#inputFile').bind('change', function () {
                                        if (this.files[0].size > 8000000) {
                                            alert("This file is too big. Max 8 MB.");
                                            document.getElementById("inputFile").value = "";
                                        }
                                    });
                                </script>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                @foreach($servers as $server)
                    <form method="POST" action="{{route('update.server')}}" class="card m-2"
                          enctype="multipart/form-data" style="width: 50rem;">
                        @csrf
                        <div class="card-header">
                            <input type="text" class="form-control" name="server_name" required
                                   value="{{$server->name}}">
                        </div>
                        <div class="card-body">
                            <label>API Token:</label>
                            <p>{{$server->api_token}}</p>
                            <label>Server Token:</label>
                            <p>{{$server->server_token}}</p>

                            <label> URL:</label>
                            <input type="text" class="form-control" name="server_url"
                                   value="{{$server->url}}">

                            <label> Description:</label>
                            <input type="text" class="form-control" name="server_desc"
                                   value="{{$server->desc}}">

                            <label> Max-Level:</label>
                            <input type="number" class="form-control" name="server_level"
                                   value="{{$server->level}}">

                            <label> Language:</label>
                            <input type="text" class="form-control" name="server_lang"
                                   value="{{$server->lang}}">

                            <label> Class: </label>
                            <select name="server_class" class="form-select">
                                <option {{$server->class==0?"selected":""}} value="0">Oldschool</option>
                                <option {{$server->class==1?"selected":""}} value="1">Middleschool</option>
                                <option {{$server->class==2?"selected":""}} value="2">Newschool</option>
                                <option {{$server->class==3?"selected":""}} value="3">PvP</option>
                            </select>

                            <label> Banner: </label>
                            <img src="banners/{{$server['banner']}}"
                                 style="max-width: 200px; max-height: 80px;">
                            <input type="file"
                                   name="server_banner"
                                   id="inputFile"
                                   class="form-control"
                                   accept="image/*">
                            <div class="form-text">Will be shown as 500x200. Max 8 MB.</div>
                            <br>
                            <span>Status: <b
                                    style="color:{{$server->status=='okay'?'green':'red'}};">{{$server->status}}</b></span>
                            <br>
                            <span>Votes: {{$server->votesCount}}</span>
                        </div>
                        <input type="hidden" name="serverId" value="{{$server->id}}">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
