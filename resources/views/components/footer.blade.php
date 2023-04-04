<!-- Footer -->
<footer class="bg-tranparent text-center text-white " style="padding-top: 50px">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <a class="btn " href="https://www.metin2downloads.to/" target="_blank"
           role="button">
            <img class="footerIcon" src="{{url('/icons/m2dl.png')}}" alt="Image" style="height: 20px"/>
        </a>
        <a style="color: whitesmoke!important;text-decoration: none" href="{{route('disclaimerPage')}}">Disclaimer</a>
        <br>
        @if(Auth::check())
            <span style="color: whitesmoke!important;">Problems ? Volvox#7662</span>
        @endif
    </div>
    <span style="font-size: xx-small">Metin2, das Metin2 Logo und Metin2 Grafiken sind Marken der YMIR. Co., Ltd. Metin2 Deutschland wird herausgegeben von Gameforge 4D GmbH. Weitere hier verwendete Kennzeichen sind Marken ihrer jeweiligen Eigentümer. Wir stehen in keinerlei Verbindung oder Partnerschaft zu ihnen. Dies ist eine Metin2 P Server Toplist für Metin2 privat Server.</span>
    <!-- Copyright -->
</footer>
<!-- Footer -->
