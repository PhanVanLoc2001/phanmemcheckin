<header class="header-area">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">

            <nav class="classy-navbar justify-content-between" id="conferNav">

                <a class="nav-brand" href="{{ url('') }}"><img src="{{ url('img/logoninja.webp') }}" alt="logo"></a>

                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <div class="classy-menu">

                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <div class="classynav">
                        <ul id="nav">
                            @if (isset($menus) && count($menus) > 0)
                                @foreach ($menus as $menu)
                                    @if ($menu->position == 'header-center')
                                        @if ($menu->menuItems->count() > 0)
                                            @php($menuItems = $menu->menuItems)
                                            {!! showMenuItems($menuItems) !!}
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <p>Menu đang trống.</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
