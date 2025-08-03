<x-login.layout>
    <x-toast />
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-xxl-3 col-lg-4 col-md-5">
            <div class="auth-full-page-content d-flex p-sm-10 p-10 bg-white rounded-4">
                <div class="w-100">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4 mb-md-5 text-center">

                        </div>

                        <div class="auth-content my-auto">
                            <div class="card shadow rounded p-4">
                                <div class="text-center">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{ asset('assets/images/sumenep.jpg') }}" alt=""
                                            height="28"> <span class="logo-txt">AHP Hama dan Penyakit Jagung</span>
                                    </a>
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue to Sumenep.</p>
                                </div>
                                <form class="mt-4 pt-2" method="POST" action="{{ route('login-proses') }}" novalidate>
                                    @csrf
                                    <!-- Email dan Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label">Password</label>
                                            </div>
                                        </div>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light shadow-none ms-0" type="button"
                                                id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Forgot password -->
                                    <div class="mb-2 text-end">
                                        <a href="#" class="text-muted">Forgot password?</a>
                                    </div>

                                    <!-- Buttons -->
                                    <hr>
                                    <div class="mb-3">
                                        <button class="btn w-100 waves-effect waves-light" type="submit"
                                            style="background-color: #43b634; border-color: #43b634; color: #fff;">
                                            Log In
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-outline-secondary w-100" type="reset">
                                            Reset
                                        </button>
                                    </div>
                                </form>
                                <div class="mb-3 text-center">
                                    <a href="{{ route('register.show') }}" class="text-primary">Belum punya akun?
                                        Register</a>
                                </div>
                            </div> <!-- end card -->
                        </div>


                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Sumenep . Crafted with <i
                                    class="mdi mdi-heart text-danger"></i>
                                Ujan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end auth full page content -->
        </div>

    </div>
</x-login.layout>
