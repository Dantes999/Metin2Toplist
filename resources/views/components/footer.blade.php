<!-- Footer -->
<footer class="bg-tranparent text-center text-white " style="padding-top: 50px">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <a class="btn " href="https://www.metin2downloads.to/" target="_blank"
           role="button">
            <img class="footerIcon" src="{{url('/icons/m2dl.png')}}" alt="Image" style="height: 20px"/>
        </a>
        <a class="btn " href="https://metin2.dev/" target="_blank"
           role="button">
            <img class="footerIcon" src="{{url('/icons/m2dev.png')}}" alt="Image" style="height: 20px"/>
        </a>
        <a style="color: whitesmoke!important;text-decoration: none" href="{{route('disclaimerPage')}}">{{__('custom.disclaimer')}}</a>
        <br>
        @if(Auth::check())
            <span style="color: whitesmoke!important;">Problems ? Volvox#7662</span>
        @endif
    </div>
    <span style="font-size: xx-small">{{__('custom.footerText1')}}</span>
    <span style="font-size: xx-small">{{__('custom.footerText2')}}</span>
    <!-- Copyright -->
</footer>
<!-- Footer -->
