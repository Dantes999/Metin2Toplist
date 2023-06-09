<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark {{Auth::user()&&Auth::user()->isAdmin()?"bg-danger":"bg-tranparent"}}">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="{{route('servers')}}">
            <h5 class="pt-1">Metin2Toplist</h5>
        </a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">{{__('custom.dashboard')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('howToPage')}}">{{__('custom.howTo')}}</a>
                    </li>

                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('getAdminPage')}}">{{__('custom.admin')}}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('register')}}">{{__('custom.register')}}</a>
                    </li>
                @endauth
            </ul>
            <!-- Left links -->

            <!-- Right elements -->
            <div class="d-flex align-items-center justify-content-start">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('locale/de') }}"><i class="flag-icon flag-icon-de"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('locale/en') }}"><i class="flag-icon flag-icon-gb"></i></a>
                    </li>
                    @auth()
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('logout')}}">{{__('custom.logout')}}</a>
                        </li>
                    @else()
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('login')}}">{{__('custom.login')}}</a>
                        </li>
                    @endauth
                </ul>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
