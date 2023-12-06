<div id="kt_header" class="header align-items-stretch" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
    <div class="container-xxl d-flex align-items-center">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-3" title="Show aside menu">
            <div class="btn btn-icon btn-custom w-35px h-35px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>
        {{-- <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
            <a href="{{url('/')}}">
                <img alt="Logo" src="assets/media/logos/logo-dark.png" class="h-15px h-lg-20px logo-default" style="height: 45px !important;"/>
                <img alt="Logo" src="assets/media/logos/default.svg" class="h-15px h-lg-20px logo-sticky" />
            </a>
        </div> --}}
<<<<<<< HEAD
        
=======
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                        <div class="menu-item me-lg-1 @yield('show-1')">
<<<<<<< HEAD
                            <div>
                                <!--begin::Toggle-->
                                <button type="button" class="btn btn-primary rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="30px, 30px">
                                    Home
                                    <span class="svg-icon fs-3 rotate-180 ms-3 me-0"><i class="fa-solid fa-bars"></i></span>
                                </button>
                                <!--end::Toggle-->
        
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-6 text-dark fw-bold px-3 py-4"><h6>Menú</h6></div>
                                    </div>
                                    <!--end::Menu item-->
        
                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->
        
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <span class="menu-title">
                                            <a class="menu-link px-3 text-dark" href="{{('/dashboard')}}">Dashboard</a>
                                        </span>
                                    </div>
                                    <!--end::Menu item-->
        
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <span class="menu-title">
                                            <a class="menu-link px-3 text-dark" href="{{('/')}}">Sugerencias</a>
                                        </span>
                                    </div>
                                    <!--end::Menu item-->
        
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <span class="menu-title">
                                            <a class="menu-link px-3 text-dark" href="{{('/area')}}">Áreas</a>
                                        </span>
                                    </div>
                                    <!--end::Menu item-->
        
                                    <!--begin::Menu separator-->
                                    <div class="separator mt-3 opacity-75"></div>
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Dropdown wrapper-->
                            
=======
                            <span class="menu-link py-3">
                                <span class="menu-title">Inicio</span>
                            </span>
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD

=======
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="topbar d-flex align-items-stretch flex-shrink-0">
                    <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                        <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img alt="Pic" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" />
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" />
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name}}
                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span></div>
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->user_type}}</a>
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
    </div>
</div>