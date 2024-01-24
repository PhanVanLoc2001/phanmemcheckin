@php
    //    $active = request()->segments()[0];
    $active = implode(',', request()->segments());

    //    dd($active_1);admin,post
    $labelPost = in_array($active, ['admin,posts', 'admin,categories', 'admin,tags', 'admin,posts,create']);
    $labelUser = in_array($active, ['admin,users', 'admin,roles', 'admin,permissions']);
    $labelProduct = in_array($active, ['admin,products', 'admin,products,categories', 'admin,products,create', 'admin,tags']);
    $labelRecruitment = in_array($active, ['admin,recruitments', 'admin,recruitments,create']);
    $labelMenu = in_array($active, ['admin,menus', 'admin,menus,create']);
    $labelPage = in_array($active, ['admin,pages', 'admin,pages,create']);
    $labelHome = $active == 'home';
    $labelContact = $active == 'admin,contacts';
    $labelMedia = $active == 'admin,media';
    $labelSetting = $active == 'admin,settings,1,edit';
    //        dd($active);
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo justify-content-center">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ url('assets/img/logo-admin.webp') }}" alt="avt-admin">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item  @if ($labelHome) active open @endif">
            <a href="{{ '/home' }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item @if ($labelPost) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Bài viết</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if ($active == 'admin,posts,create') active @endif">
                    <a href="{{ route('posts.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Thêm bài viết</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,posts') active @endif">
                    <a href="{{ route('posts.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Danh sách bài viết</div>
                    </a>
                </li>
                <li class="menu-item  @if ($active == 'admin,categories') active @endif">
                    <a href="{{ route('categories.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Danh mục</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,tags') active @endif">
                    <a href="{{ route('tags.index') }}" class="menu-link">
                        <div data-i18n="Container">Thẻ</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if ($labelProduct) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Layouts">Sản Phẩm</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if ($active == 'admin,products,create') active @endif">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Thêm sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,products') active @endif">
                    <a href="{{ route('products.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Danh sách sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item  @if ($active == 'admin,products,categories') active @endif">
                    <a href="{{ route('categories-show') }}" class="menu-link">
                        <div data-i18n="Without navbar">Danh mục</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,tags') active @endif">
                    <a href="{{ route('tags.index') }}" class="menu-link">
                        <div data-i18n="Container">Thẻ</div>
                    </a>
                </li>
            </ul>
        </li>
        <li style="display: none;" class="menu-item @if ($labelRecruitment) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Layouts">Tuyển dụng</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item  @if ($active == 'admin,recruitments,create') active @endif">
                    <a href="{{ route('recruitments.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Thêm</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,recruitments') active @endif">
                    <a href="{{ route('recruitments.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Danh sách tuyển dụng</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if ($labelMenu) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div data-i18n="Menu Settings">Quản lý menu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if ($active == 'admin,menus,create') active @endif">
                    <a href="{{ route('menus.create') }}" class="menu-link">
                        <div data-i18n="Create Menu">Thêm mới</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,menus') active @endif">
                    <a href="{{ route('menus.index') }}" class="menu-link">
                        <div data-i18n="/Menu">Danh sách menu</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if ($labelPage) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Menu Settings">Quản lý Page</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if ($active == 'admin,pages,create') active @endif">
                    <a href="{{ route('pages.create') }}" class="menu-link">
                        <div data-i18n="Create Menu">Thêm mới</div>
                    </a>
                </li>
                <li class="menu-item @if ($active == 'admin,pages') active @endif">
                    <a href="{{ route('pages.index') }}" class="menu-link">
                        <div data-i18n="/Page">Danh sách page</div>
                    </a>
                </li>
            </ul>
        </li>
        @php
            $isSuperAdmin = Auth::user()->hasRole('super-admin');
        @endphp

        @if ($isSuperAdmin || Gate::allows('user-menu'))
            <li class="menu-item @if ($labelUser) active open @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div data-i18n="Account Settings">Cài đặt tài khoản</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item @if ($active == 'admin,users') active @endif">
                        <a href="{{ route('users.index') }}" class="menu-link">
                            <div data-i18n="Account">Tài khoản</div>
                        </a>
                    </li>
                    <li class="menu-item @if ($active == 'admin,roles') active @endif">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <div data-i18n="/Notifications">Vai trò</div>
                        </a>
                    </li>
                    <li class="menu-item @if ($active == 'admin,permissions') active @endif">
                        <a href="{{ route('permissions.index') }}" class="menu-link">
                            <div data-i18n="/Connections">Quyền</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li style="display: none;" class="menu-item @if ($labelContact) active open @endif">
            <a href="{{ route('contacts.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Basic">Liên hệ</div>
            </a>
        </li>

        <li class="menu-item @if ($labelMedia) active open @endif">
            <a href="{{ route('media.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-carousel"></i>
                <div data-i18n="Basic">Thư viện</div>
            </a>
        </li>

        <li class="menu-item @if ($labelSetting) active open @endif">
            <a href="{{ route('settings.edit', ['setting' => 1]) }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cog"></i>
                <div data-i18n="Basic">Cài đặt thông tin</div>
            </a>
        </li>
    </ul>
</aside>
