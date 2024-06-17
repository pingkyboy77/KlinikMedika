<!-- LOGO -->
<div class="navbar-brand-box">
    <a href="#" class="logo logo-dark">
        <span class="logo-sm mt-3">
            <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="26">

        </span>
        <span class="logo-lg">
            {{-- <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="28"> --}}
            <div class="row d-flex justify-content-start align-items-center m-1 mt-2">
                <div class="col-2 p-0">
                    <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="28">
                </div>
                <div class="col-10 p-0">
                    <h6 class=" text-left m-0">FAKULTAS ILMU KOMPUTER</h6>
                </div>
            </div>

            <hr class=" bg-yellow-50 m-0">
        </span>
    </a>

    <a href="#" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="30">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="26">
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
    <i class="bx bx-menu align-middle"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu" class="mt-4 p-0">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">

            <li>
                <a href="{{ route('dosen.beranda') }}">
                    <i class="bx bx-home-alt icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.daftarBimbingan') }}">
                    <i class="bx bx-list-ul icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Daftar Bimbingan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.pengajuanLomba') }}">
                    <i class="bx bx-calendar-event icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Pengajuan Lomba</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.jadwalBimbingan') }}">
                    <i class="bx bx-calendar-check icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Pengajuan Bimbingan</span>
                </a>
            </li>


        </ul>
    </div>
    <!-- Sidebar -->
</div>
@include('layouts.horizontal-nav')
