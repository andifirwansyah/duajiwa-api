<nav class="side-nav">
    <ul>
        <li>
            <a href="{{url('/')}}" class="side-menu {{ Request::segment(1) == '' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                    <div class="side-menu__sub-icon transform rotate-180"> </div>
                </div>
            </a>
        </li>
        <li>
            <a href="side-menu-light-inbox.html" class="side-menu {{ Request::segment(1) == 'orders' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="credit-card"></i> </div>
                <div class="side-menu__title"> Orders </div>
            </a>
        </li>
        <li>
            <a href="{{url('/theme')}}" class="side-menu {{ Request::segment(1) == 'theme' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="layout"></i> </div>
                <div class="side-menu__title"> Themes </div>
            </a>
        </li>

        <li>
            <a href="javascript:;.html" class="side-menu {{ (Request::segment(1) == 'package' ? 'side-menu--active' : '') || Request::segment(1) == 'package-feature' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="package"></i> </div>
                <div class="side-menu__title">
                    Packages
                    <div class="side-menu__sub-icon transform rotate-0"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            {{-- side-menu__sub-open --}}
            <ul class="{{(Request::segment(1) == 'package' ? 'side-menu__sub-open' : '') || Request::segment(1) == 'package-feature' ? 'side-menu__sub-open' : ''}}">
                <li>
                    <a href="{{url('/package')}}" class="{{Request::segment(1) == 'package' ? 'side-menu side-menu--active' : 'side-menu'}}">
                        <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                        <div class="side-menu__title"> Package Lists </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/package-feature')}}" class="{{Request::segment(1) == 'package-feature' ? 'side-menu side-menu--active' : 'side-menu'}}">
                        <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                        <div class="side-menu__title"> Package Features </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;.html" class="side-menu {{ Request::segment(1) == 'setting' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                <div class="side-menu__title">
                    Settings
                    <div class="side-menu__sub-icon transform rotate-0"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            {{-- side-menu__sub-open --}}
            <ul class="{{Request::segment(1) == 'setting' ? 'side-menu__sub-open' : ''}}">
                <li>
                    <a href="{{url('/setting/creator')}}" class="{{Request::segment(2) == 'creator' ? 'side-menu side-menu--active' : 'side-menu'}}">
                        <div class="side-menu__icon"> <i data-lucide="git-pull-request"></i> </div>
                        <div class="side-menu__title"> Creators </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-dashboard-overview-2.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="key"></i> </div>
                        <div class="side-menu__title"> Tags </div>
                    </a>
                </li>
                <li>
                    <a href="{{url('/setting/theme-category')}}" class="{{Request::segment(2) == 'theme-category' ? 'side-menu side-menu--active' : 'side-menu'}}">
                        <div class="side-menu__icon"> <i data-lucide="package"></i> </div>
                        <div class="side-menu__title"> Theme Category </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="side-nav__devider my-6"></li>
    </ul>
</nav>
