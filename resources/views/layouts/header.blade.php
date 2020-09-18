<div class="tb-height-b60 tb-height-lg-b60"></div>
<header class="tb-header tb-style1 tb-sticky-menu">
    <div class="tb-main-header">
        <div class="tb-main-header-in">
            <div class="tb-main-header-left">
                <a href="{{ url('/') }}" class="tb-logo-link tb-light-logo">
                    <img src="{{ asset('') }}/img/logo2.png" style="width:40%" alt="logo-light" />
                </a>
                <a href="{{ url('/') }}" class="tb-logo-link tb-dark-logo">
                    <img src="{{ asset('') }}/img/logo2.png" style="width:40%" alt="logo-dark" />
                </a>
            </div>
            <div class="tb-main-header-right">
                <div class="tb-nav-wrap tb-fade-up">
                </div>
                <!-- .tb-nav-wrap -->
                <ul class="tb-ex-nav tb-style1 tb-flex tb-mp0">
                    <li>
                        <div class="tb-toggle-body tb-profile-nav tb-style1">
                            <div class="tb-toggle-btn tb-profile-nav-btn">
                                <div class="tb-profile-nav-text">
                                    <span>Welcome,</span>
                                    <h4>{{ Auth::user()->name }}</h4>
                                </div>
                            </div>
                            <ul class="tb-dropdown tb-style1">
                                <li>
                                    <a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Sign Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header><!-- .tb-header -->
