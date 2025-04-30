<!-- LOGO -->
<div class="px-3">
    <a href="#" class="logo logo-dark">
        <span class="logo-sm justify-content-start align-items-center">
            <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="20">
        </span>
        <span class="logo-lg">
            {{-- <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="28"> --}}
            <div class="row d-flex justify-content-start align-items-center m-1 mt-2">
                <div class="col-4 p-0">
                    <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="28">
                </div>
                <div class="col-7 p-0">
                    <h6 class=" text-left m-0">Klinik Inova Medika</h6>
                </div>
            </div>

            <hr class=" bg-yellow-50 m-0">
        </span>
    </a>

    <a href="#" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="20">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="20">
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
    <i class="bx bx-menu align-middle"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll m-0">

    <!--- Sidemenu -->
    <div id="sidebar-menu" class="mt-4 p-0">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">

            <li>
                <a href="{{ route('beranda') }} ">
                    <i class="bx bx-home-alt icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <!-- MASTER MENU - hanya untuk admin -->
@if(auth()->user()->isAdmin())
<li class="nav-item">
    <a href="#masterSubmenu" data-bs-toggle="collapse" class="nav-link">
        <i class="bx bx-folder icon nav-icon"></i>
        <span class="menu-item">Master</span>
        <i class="bx bx-chevron-down ms-auto"></i>
    </a>
    <ul class="collapse list-unstyled ps-3" id="masterSubmenu">
        <li>
            <a href="{{ route('admin.user-Management') }}" class="nav-link">
                <i class="bx bx-user-circle nav-icon"></i>
                User
            </a>
        </li>
        <li>
            <a href="{{ route('admin.region.index') }}" class="nav-link">
                <i class="bx bx-map-alt nav-icon"></i>
                Region
            </a>
        </li>
        <li>
            <a href="{{ route('admin.staff.index') }}" class="nav-link">
                <i class="bx bx-id-card nav-icon"></i>
                Staff
            </a>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}" class="nav-link">
                <i class="bx bx-cog nav-icon"></i>
                Service
            </a>
        </li>
        <li>
            <a href="{{ route('admin.drugs.index') }}" class="nav-link">
                <i class="bx bxs-capsule nav-icon"></i>
                Drug
            </a>
        </li>
    </ul>
</li>
@endif

<!-- PASIEN MENU - untuk admin dan staff -->

<li class="nav-item">
    <a href="#pasienSubmenu" data-bs-toggle="collapse" class="nav-link">
        <i class="bx bx-transfer icon nav-icon"></i>
        <span class="menu-item">Trasaction</span>
        <i class="bx bx-chevron-down ms-auto"></i>
    </a>
    <ul class="collapse list-unstyled ps-3" id="pasienSubmenu">
        @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
        <li>
            <a href="{{ route('staff.pasiens.index') }}" class="nav-link">
                <i class="bx bx-user nav-icon"></i>
                Pasien
            </a>
        </li>

        <li>
            <a href="{{ route('staff.visit.index') }}" class="nav-link">
                <i class="bx bx-plus-medical nav-icon"></i>
                Progress Tindakan
            </a>
        </li>
@endif
        @if(auth()->user()->isDoctor())
        <li>
            <a href="{{ route('dokter.tindakan.index') }}" class="nav-link">
                <i class="bx bx-plus-medical nav-icon"></i>
                On Going Tindakan
            </a>
        </li>
        @endif

        @if(auth()->user()->isAdmin() || auth()->user()->isCashier())
        <li>
            <a href="{{ route('kasir.billing.index') }}" class="nav-link">
                <i class="bx bx-money nav-icon"></i>
                Billing
            </a>
        </li>
        @endif
    </ul>
</li>





        </ul>
    </div>
    <!-- Sidebar -->
</div>
@include('layouts.horizontal-nav')
