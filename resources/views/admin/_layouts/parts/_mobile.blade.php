<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone - HTML Admin Template" class="w-6" src="{{asset('admin/dist/images/logo.svg')}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        <li>
            <a href="javascript:;.html" class="menu menu--active">
                <div class="menu__icon"> <i data-lucide="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="javascript:;.html" class="menu">
                <div class="menu__icon"> <i data-lucide="inbox"></i> </div>
                <div class="menu__title"> Transaction </div>
            </a>
        </li>
        <li>
            <a href="{{url('/theme')}}" class="menu">
                <div class="menu__icon"> <i data-lucide="hard-drive"></i> </div>
                <div class="menu__title"> Theme </div>
            </a>
        </li>
    </ul>
</div>
