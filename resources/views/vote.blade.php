<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">

    <meta name="theme-color" content="#ffffff">

    <title>Metin2Toplist-Vote</title>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

    <script src="https://www.google.com/recaptcha/api.js?render={{env('RECAPTCHA_SITE_KEY')}}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('{{env('RECAPTCHA_SITE_KEY')}}', {action: 'validate_captcha'})
                .then(function (token) {
                    if (document.getElementById('g-recaptcha-response') != null) {
                        document.getElementById('g-recaptcha-response').value = token;
                    }
                });
        });
    </script>
    <link href="{{ asset('css/vote.css?v=').time() }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="bg">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$errors->first()}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(isset($serverToken) and isset($accountId))
        <div class="login-dark">
            <form action="{{route('vote')}}" method="POST" id="voteForm">
                @csrf
                <input type="hidden" id="Q5bHgjeKWUTRzVMLYNYfR" name="Q5bHgjeKWUTRzVMLYNYfR" value="{{$serverToken}}">
                <input type="hidden" id="w3vQTdZHqpAvFvbj76zDv" name="w3vQTdZHqpAvFvbj76zDv" value="{{$accountId}}">
                <label class="login-from" for="name"></label>
                <input class="login-from" autocomplete="off" type="text" id="name" name="name"
                       placeholder="Your name here">
                <label class="login-from" for="email"></label>
                <input class="login-from" autocomplete="off" type="email" id="email" name="email"
                       placeholder="Your e-mail here">
                <label class="login-from" for="serverId"></label>
                <input class="login-from" autocomplete="off" type="text" id="serverId" name="serverId"
                       placeholder="Your serverId here">
                <label class="login-from" for="accountId"></label>
                <input class="login-from" autocomplete="off" type="text" id="accountId" name="accountId"
                       placeholder="Your accountId here">
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <input type="hidden" name="action" value="validate_captcha">

                <button type="submit" id="voteSubmit" class="glow-on-hover">vote</button>
            </form>
        </div>
    @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Missing Server and Account Data. Contact: Volvox#7662</strong>
        </div>
    @endif
</div>
</body>
</html>
