@extends('welcome')

@section('content')
    <div style="color: whitesmoke">
        <h3>{{__('disclaimer.disclaimer1header')}}</h3><br>
        <b><span style="font-size: small; ">{{__('disclaimer.disclaimer1text')}}</span></b>
        <span><b><br><br>{{__('disclaimer.disclaimer2header')}}</b></span>
        <p><br>
            <br>
            {{__('disclaimer.disclaimer2text')}}<br>
            <br>
            &nbsp;</p>

        <span><b>{{__('disclaimer.disclaimer3header')}} </b></span>
        <p><br>
            <br>
            {{__('disclaimer.disclaimer3text')}} <br>
            <br>
            &nbsp;</p>

        <span><b>{{__('disclaimer.disclaimer4header')}}</b></span>
        <p><br>
            <br>
            {{__('disclaimer.disclaimer4text')}} <br>
            <br>
            &nbsp;</p>
        <span><b>{{__('disclaimer.disclaimer5header')}}</b></span>
        <p><br>
            <br>
            {{__('disclaimer.disclaimer5text')}} <br>
            <br>
            &nbsp;</p>
        <span><b>{{__('disclaimer.disclaimer6header')}} </b></span>
        <p><br>
            <br>
            {{__('disclaimer.disclaimer6text')}} <br>
            <br>
            &nbsp;</p>
    </div>
@endsection

