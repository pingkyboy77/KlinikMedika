@extends('auth.app-login')
<div class="authentication-bg min-vh-100">
    <div class=" bg-overlay bg-opacity-80 bg-light">
    </div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-9 col-lg-8 col-xl-8">

                    <div class="mb-4 pb-2 d-flex container-fluid gap-3 justify-content-center align-items-center">
                        <a href="{{ route('mahasiswa.beranda') }}" class="d-block auth-logo">
                            <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="90"
                                class="auth-logo-dark me-start">
                            <img src="{{ asset('images/logo-upn2.png') }}" alt="" height="90"
                                class="auth-logo-light me-start">
                        </a>
                        <h3 class=" fw-bolder text-center" style="font-family: poppins, sans-serrif">UNIVERSITAS VETERAN
                            JAKARTA</h3>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5>Welcome Back !</h5>
                                <p class="text-muted">Bimbingan Lomba UPN Website</p>
                            </div>
                            <div class="p-2 mt-4 d-flex gap-3 flex-wrap justify-content-center align-items-center">
                                <a href="">
                                    <button class="btn btn-info">Masuk Sebagai Dosen</button>
                                </a>
                                <a href="{{ route('login') }}">
                                    <button class="btn btn-info">Masuk Sebagai Mahasiswa</button>
                                </a>
                                <a href="{{ route('login') }}">
                                    <button class="btn btn-info">Masuk Sebagai Admin</button>
                                </a>
                            </div>

                        </div>
                    </div>

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center p-4">
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> DraftCoding - Krisna Yuda Nugraha
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->

</div>
