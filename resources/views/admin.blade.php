@extends('welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="color:whitesmoke;">
            <h4 style="color: whitesmoke">Server Check:</h4>
            <details>
                <div class="d-flex justify-content-center" style="color: black">
                    @foreach($serversCheck as $server)
                        <div class="card m-2" style="width: 50rem;">
                            <div class="card-header">
                                <input type="text" class="form-control" name="server_name" required
                                       value="{{$server->name}}">
                            </div>
                            <form class="card-body" method="POST" action="{{route('update.server')}}"
                                  enctype="multipart/form-data" id="updateFormCheck">
                                @csrf
                                <label>API Token:</label>
                                <input type="text" class="form-control" name="server_api_token"
                                       value="{{$server->api_token}}">
                                <label>Server Token:</label>
                                <input type="text" class="form-control" name="server_server_token"
                                       value="{{$server->server_token}}">
                                <label> URL:</label>
                                <input type="text" class="form-control" name="server_url"
                                       value="{{$server->url}}">

                                <label> Description:</label>
                                <input type="text" class="form-control" name="server_desc"
                                       value="{{$server->desc}}">

                                <label> Max-Level:</label>
                                <input type="text" class="form-control" name="server_level"
                                       value="{{$server->level}}">

                                <label> Language:</label>
                                <input type="text" class="form-control" name="server_lang"
                                       value="{{$server->lang}}">

                                <label> Klasse: </label>
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
                                <input type="hidden" name="serverId" value="{{$server->id}}">
                            </form>
                            <div class="card-footer" style="display: flex">
                                <form method="POST" action="{{route('okayServer')}}">
                                    @csrf
                                    <input type="hidden" value="{{$server->id}}" name="serverId">
                                    <input type="hidden" value="0" name="block">
                                    <button class="btn btn-outline-success" type="submit">Okay</button>
                                </form>
                                <form method="POST" action="{{route('blockServer')}}">
                                    @csrf
                                    <input type="hidden" value="{{$server->id}}" name="serverId">
                                    <input type="hidden" value="1" name="block">
                                    <button class="btn btn-outline-danger" type="submit">Block</button>
                                </form>
                                <button type="submit" class="btn btn-primary" id="updateFormCheckButton">
                                    Update
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </details>
            <h4 style="color: whitesmoke">Server Block:</h4>
            <details>
                <div class="d-flex justify-content-center" style="color: black">
                    @foreach($serversBlock as $server)
                        <div class="card m-2"
                             style="width: 50rem;">

                            <div class="card-header">
                                <input type="text" class="form-control" name="server_name" required
                                       value="{{$server->name}}">
                            </div>
                            <form class="card-body" method="POST" action="{{route('update.server')}}"
                                  enctype="multipart/form-data" id="updateFormBlock">
                                @csrf
                                <label>API Token:</label>
                                <input type="text" class="form-control" name="server_api_token"
                                       value="{{$server->api_token}}">
                                <label>Server Token:</label>
                                <input type="text" class="form-control" name="server_server_token"
                                       value="{{$server->server_token}}">

                                <label> URL:</label>
                                <input type="text" class="form-control" name="server_url"
                                       value="{{$server->url}}">

                                <label> Description:</label>
                                <input type="text" class="form-control" name="server_desc"
                                       value="{{$server->desc}}">

                                <label> Max-Level:</label>
                                <input type="text" class="form-control" name="server_level"
                                       value="{{$server->level}}">

                                <label> Language:</label>
                                <input type="text" class="form-control" name="server_lang"
                                       value="{{$server->lang}}">

                                <label> Klasse: </label>
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
                                <input type="hidden" name="serverId" value="{{$server->id}}">
                            </form>
                            <div class="card-footer" style="display: flex">
                                <form method="POST" action="{{route('okayServer')}}">
                                    @csrf
                                    <input type="hidden" value="{{$server->id}}" name="serverId">
                                    <input type="hidden" value="0" name="block">
                                    <button class="btn btn-outline-success" type="submit">Okay</button>
                                </form>
                                <button type="submit" class="btn btn-primary" id="updateFormBlockButton">
                                    Update
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </details>
            <h4 style="color: whitesmoke">Server Okay:</h4>
            <details>
                <div class="d-flex justify-content-center" style="color: black">
                    @foreach($serversOkay as $server)
                        <div class="card m-2"
                             style="width: 50rem;">

                            <div class="card-header">
                                <input type="text" class="form-control" name="server_name" required
                                       value="{{$server->name}}">
                            </div>
                            <form class="card-body" method="POST" action="{{route('update.server')}}"
                                  enctype="multipart/form-data" id="updateFormOkay">
                                @csrf
                                <label>API Token:</label>
                                <input type="text" class="form-control" name="server_api_token"
                                       value="{{$server->api_token}}">
                                <label>Server Token:</label>
                                <input type="text" class="form-control" name="server_server_token"
                                       value="{{$server->server_token}}">

                                <label> URL:</label>
                                <input type="text" class="form-control" name="server_url"
                                       value="{{$server->url}}">

                                <label> Description:</label>
                                <input type="text" class="form-control" name="server_desc"
                                       value="{{$server->desc}}">

                                <label> Max-Level:</label>
                                <input type="text" class="form-control" name="server_level"
                                       value="{{$server->level}}">

                                <label> Language:</label>
                                <input type="text" class="form-control" name="server_lang"
                                       value="{{$server->lang}}">

                                <label> Klasse: </label>
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
                                <input type="hidden" name="serverId" value="{{$server->id}}">
                            </form>


                            <div class="card-footer" style="display: flex">
                                <button type="submit" class="btn btn-primary" id="updateFormOkayButton">
                                    Update
                                </button>
                                <form method="POST" action="{{route('blockServer')}}">
                                    @csrf
                                    <input type="hidden" value="{{$server->id}}" name="serverId">
                                    <input type="hidden" value="1" name="block">
                                    <button class="btn btn-outline-danger" type="submit">Block</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </details>
            <h4 style="color: whitesmoke">User:</h4>
            <details>
                <div class="d-flex justify-content-center">
                    <table class="table" style="color:whitesmoke;">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">created_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </details>
        </div>
    </div>
    </div>
    <script>
        let formBlock = document.getElementById("updateFormBlock");
        document.getElementById("updateFormBlockButton").addEventListener("click", function () {
            formBlock.submit();
        });

        let formOkay = document.getElementById("updateFormOkay");
        document.getElementById("updateFormOkayButton").addEventListener("click", function () {
            formOkay.submit();
        });

        let formCheck = document.getElementById("updateFormCheck");
        document.getElementById("updateFormCheckButton").addEventListener("click", function () {
            formCheck.submit();
        });

    </script>
@endsection
