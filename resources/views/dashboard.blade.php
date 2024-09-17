@extends('welcome')

@section('content')
    <div class="container bg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('custom.create_new_server') }}</div>
                    <div class="card-body">
                        <form action="{{ route('create.server') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="server_name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.server_name') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_name" class="form-control" name="server_name" required
                                           value="{{ old('server_name') }}" autofocus maxlength="100">
                                </div>

                                <label for="server_desc" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.server_description') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_desc" class="form-control" name="server_desc"
                                           value="{{ old('server_desc') }}"
                                           placeholder="{{ __('custom.describe_server') }}" maxlength="100">
                                </div>

                                <label for="server_url" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.server_url') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_url" class="form-control" name="server_url"
                                           value="{{ old('server_url') }}"
                                           placeholder="https://www.YOURSERVER.de" maxlength="50">
                                    <div class="form-text">
                                        {{ __('custom.correct_url_message') }}
                                    </div>
                                </div>

                                <label for="server_level" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.max_level') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="number" id="server_level" class="form-control" name="server_level"
                                           value="{{ old('server_level') }}"
                                           placeholder="99" maxlength="4">
                                </div>

                                <label for="server_lang" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.language') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text" id="server_lang" class="form-control" name="server_lang"
                                           value="{{ old('server_lang') }}"
                                           placeholder="de|en" maxlength="40">
                                    <div class="form-text">
                                        {{ __('custom.lang_format_message') }} <br>
                                        <a target="_blank" href="https://flagicons.lipis.dev/">
                                            {{ __('custom.short_form_of_country') }}
                                        </a>
                                    </div>
                                </div>

                                <label for="server_class" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.server_class') }}
                                </label>
                                <div class="col-md-6">
                                    <select name="server_class" class="form-select">
                                        <option {{ old('server_class') == '0' ? 'selected' : '' }} value="0">
                                            {{ __('custom.oldschool') }}
                                        </option>
                                        <option {{ old('server_class') == '1' ? 'selected' : '' }} value="1">
                                            {{ __('custom.middleschool') }}
                                        </option>
                                        <option {{ old('server_class') == '2' ? 'selected' : '' }} value="2">
                                            {{ __('custom.newschool') }}
                                        </option>
                                        <option {{ old('server_class') == '3' ? 'selected' : '' }} value="3">
                                            {{ __('custom.pvp') }}
                                        </option>
                                    </select>
                                </div>

                                <label for="server_banner" class="col-md-4 col-form-label text-md-right">
                                    {{ __('custom.server_banner') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="file" name="server_banner" id="inputFile" class="form-control"
                                           accept="image/*">
                                    <div class="form-text">
                                        {{ __('custom.banner_size_message') }}
                                    </div>
                                </div>

                                <script>
                                    $('#inputFile').bind('change', function () {
                                        if (this.files[0].size > 8000000) {
                                            alert("{{ __('custom.file_too_large') }}");
                                            document.getElementById("inputFile").value = "";
                                        }
                                    });
                                </script>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('custom.create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                @foreach($servers as $server)
                    <form method="POST" action="{{ route('update.server') }}" class="card m-2"
                          enctype="multipart/form-data" style="width: 50rem;">
                        @csrf
                        <div class="card-header">
                            <input type="text" class="form-control" name="server_name" required
                                   value="{{ $server->name }}">
                        </div>
                        <div class="card-body">
                            <label>{{ __('custom.api_token') }}:</label>
                            <p>{{ $server->api_token }}</p>

                            <label>{{ __('custom.server_token') }}:</label>
                            <p>{{ $server->server_token }}</p>

                            <label>{{ __('custom.url') }}:</label>
                            <input type="text" class="form-control" name="server_url" value="{{ $server->url }}">

                            <label>{{ __('custom.description') }}:</label>
                            <input type="text" class="form-control" name="server_desc" value="{{ $server->desc }}">

                            <label>{{ __('custom.max_level') }}:</label>
                            <input type="number" class="form-control" name="server_level" value="{{ $server->level }}">

                            <label>{{ __('custom.language') }}:</label>
                            <input type="text" class="form-control" name="server_lang" value="{{ $server->lang }}">

                            <label>{{ __('custom.class') }}:</label>
                            <select name="server_class" class="form-select">
                                <option
                                    {{ $server->class == 0 ? "selected" : "" }} value="0">{{ __('custom.oldschool') }}</option>
                                <option
                                    {{ $server->class == 1 ? "selected" : "" }} value="1">{{ __('custom.middleschool') }}</option>
                                <option
                                    {{ $server->class == 2 ? "selected" : "" }} value="2">{{ __('custom.newschool') }}</option>
                                <option
                                    {{ $server->class == 3 ? "selected" : "" }} value="3">{{ __('custom.pvp') }}</option>
                            </select>

                            <label>{{ __('custom.banner') }}:</label>
                            <img src="banners/{{ $server['banner'] }}" alt="banner" style="max-width: 200px; max-height: 80px;">
                            <input type="file" name="server_banner" id="inputFile" class="form-control"
                                   accept="image/*">
                            <div class="form-text">{{ __('custom.banner_size_message') }}</div>
                            <br>
                            <span>{{ __('custom.status') }}: <b
                                    style="color:{{ $server->status == 'okay' ? 'green' : 'red' }};">{{ $server->status }}</b></span>
                            <br>
                            <span>{{ __('custom.votes') }}: {{ $server->votesCount }}</span>
                        </div>

                        <input type="hidden" name="serverId" value="{{ $server->id }}">
                        <button type="submit" class="btn btn-primary">{{ __('custom.update') }}</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
