<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')

                {{-- Logout link --}}
                @php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
                @php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

                @if (config('adminlte.usermenu_profile_url', false))
                    @php( $profile_url = Auth::user()->adminlte_profile_url() )
                @endif

                @if (config('adminlte.use_route_url', false))
                    @php( $profile_url = $profile_url ? route($profile_url) : '' )
                    @php( $logout_url = $logout_url ? route($logout_url) : '' )
                @else
                    @php( $profile_url = $profile_url ? url($profile_url) : '' )
                    @php( $logout_url = $logout_url ? url($logout_url) : '' )
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{ __('adminlte::adminlte.log_out') }}</p>
                    </a>
                    <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                        @if(config('adminlte.logout_method'))
                            {{ method_field(config('adminlte.logout_method')) }}
                        @endif
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </nav>
    </div>

</aside>
