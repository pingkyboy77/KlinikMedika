@extends('auth.app-login')

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay bg-opacity-80 bg-light"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-6 pt-5">

                    <div class="mb-4 pb-2 d-flex container-fluid justify-content-center align-items-center">
                        <a href="#" class="d-block auth-logo">
                            <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="90" class="auth-logo-dark me-start">
                            <img src="{{ asset('images/logo-inovamedika.png') }}" alt="" height="90" class="auth-logo-light me-start">
                        </a>
                        <h3 class="fw-bolder text-center text-uppercase" style="font-family: poppins, sans-serif">Klinik Inova Medika Solusindo</h3>
                    </div>

                    <div class="card">
                        <div class="card-body p-4"> 
                            <div class="text-center mt-2">
                                <h5>Welcome Back !</h5>
                                <p class="text-muted">Inova Medika Solusindo Web App</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form action="{{ route('proses.login') }}" method="POST">
                                    @csrf
                                    @if (session('LoginError'))
                                        <div class="alert alert-danger">
                                            {{ session('LoginError') }}
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label" for="email">E-mail</label>
                                        <div class="position-relative input-custom-icon">
                                            <input type="text" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                id="email" 
                                                name="email" 
                                                placeholder="Enter E-mail"
                                                value="{{ old('email') }}"
                                            >
                                            <span class="bx bx-user"></span>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3">
                                        <div class="float-end">
                                            {{-- <a href="auth-recoverpw.html" class="text-muted text-decoration-underline">Forgot password?</a> --}}
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                            <span class="bx bx-lock-alt"></span>
                                            <input type="password" 
                                                class="form-control @error('password') is-invalid @enderror" 
                                                id="password-input" 
                                                name="password" 
                                                placeholder="Enter password"
                                            >
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center p-4">
                        <p>© <script>document.write(new Date().getFullYear())</script> Krisna Yuda Nugraha</p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->
    
</div>
