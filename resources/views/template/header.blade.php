<div id="kt_header" class="header align-items-stretch" data-kt-sticky="true" data-kt-sticky-name="header"
    data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <div class="container-xxl d-flex align-items-center">
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '225px'}" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <!--begin::Menu-->
                    <div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-700 menu-state-primary menu-arrow-gray-500 fw-semibold my-5 my-lg-0 px-4 px-lg-0 align-items-stretch"
                        id="#kt_header_menu" data-kt-menu="true">
                        <!--begin:Menu item-->
                        {{-- <div data-kt-menu-placement="bottom-start"
                            class="menu-item here now menu-lg-down-accordion me-lg-1">
                            <span class="menu-link py-3">
                                <span class="menu-title"><a
                                        style = "text-decoration: none; color: inherit;"href="{{ '/' }}">Sugerencias</a></span>
                            </span>
                        </div> --}}
                        <a data-kt-menu-placement="bottom-start"
                            class="menu-item here now menu-lg-down-accordion me-lg-1" href="{{ '/' }}">
                            <span class="menu-link py-3">
                                <span class="menu-title"><span
                                        style = "text-decoration: none; color: inherit;">Sugerencias</span>
                                </span>
                        </a>
                        <a data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1"
                            href="{{ '/dashboard' }}">
                            <span class="menu-link py-3">
                                <span class="menu-title"><span
                                        style = "text-decoration: none; color: inherit;">Dashboard</span>
                                </span>
                        </a>
                        <a data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1"
                            href="{{ '/area' }}">
                            <span class="menu-link py-3">
                                <span class="menu-title"><span
                                        style = "text-decoration: none; color: inherit;">Áreas</span>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="topbar d-flex align-items-stretch flex-shrink-0">
                    <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                        <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click"
                            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img alt="Pic"
                                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" />
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo"
                                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" />
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}
                                            {{-- <span
                                                class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span> --}}
                                        </div>
                                        <a href="#"
                                            class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->user_type }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-5">
                                <a href="#" class="menu-link px-5">Mi Perfil</a>
                            </div>
                            <div class="menu-item px-5">
                                {{-- <a href="{{url('logout')}}" class="menu-link px-5">Salir</a> --}}

                                <a class="menu-link px-5 " href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                            {{-- <div class="separator my-2"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Topbar-->
    </div>
</div>
