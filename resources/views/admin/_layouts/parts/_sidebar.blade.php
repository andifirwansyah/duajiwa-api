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
                <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                <div class="side-menu__title"> Orders </div>
            </a>
        </li>
        <li>
            <a href="{{url('/theme')}}" class="side-menu {{ Request::segment(1) == 'theme' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                <div class="side-menu__title"> Themes </div>
            </a>
        </li>

        <li>
            <a href="javascript:;.html" class="side-menu {{ Request::segment(1) == 'setting' ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                <div class="side-menu__title">
                    Settings
                    <div class="side-menu__sub-icon transform rotate-180"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            {{-- side-menu__sub-open --}}
            <ul class="">
                <li>
                    <a href="{{url('/setting/creator')}}" class="side-menu">
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
                    <a href="{{url('/setting/theme-category')}}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="package"></i> </div>
                        <div class="side-menu__title"> Theme Category </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="side-nav__devider my-6"></li>
    </ul>
</nav>
