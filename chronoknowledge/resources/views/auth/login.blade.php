@extends('layouts.auth')
@section('content')
    <div class="container clearfix">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-2-strong loginCard mx-auto mt-0">
                    <div class="card-body p-5 text-center">
                        <h3 class="chronoCommunity"><span class="chronoCommunity">Chronostep </span> <span class="chronoCommunity1">Community</span>  </h3>
                        <h6 class="welcome">Welcome to the amazing community of engineers in Chronostep Inc.</h6>
                        <div class="container mt-5 mb-2">
                            <a class="btn btn-lg btn-block btn-primary mb-2 facebookSignin" href="{{ route('auth.facebook') }}?method=login"
                            type="button"><i class="fab fa-facebook-f me-2 px-auto"></i>Continue with facebook</a>
                        </div>
                        <div class="container mb-4 mt-4">
                            <a class="btn btn-lg btn-block btn-primary googleSignin py-auto" href="{{ route('auth.google') }}?method=login">
                                <i class="fab fa-google me-2"></i> Continue with google</a>
                        </div>
                        <h6 class="mb-4 text-light"><span class="text-light me-4">━━</span>Have a password? Continue with your email address<span class="text-light ms-4">━━</span></h6>
                        <form action="{{ route('login') }}" class="form" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label text-light" for="typeEmailX-2" style="float:left">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg input-dark" name="email"/>
                            </div>
                            @error('email')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-4">
                                <label class="form-label text-light" for="typePasswordX-2" style="float:left">Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg input-dark" name="password"/>
                            </div>
                            @error('password')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" value="1" id="form1Example3" name="remember"/>&nbsp;&nbsp;
                                <label class="form-check-label text-light" for="form1Example3"> Remember password </label>
                            </div>
                            <button class="btn btn-primary btn-lg w-100" type="submit">Continue</button>
                        </form>
                        <div class="text-decoration-none"><a href="{{ route('password.index') }}" class="text-decoration-none">Forget Password?</a></div>
                        <div class="text-decoration-none float-left mt-4">
                            <span class="text-muted">Don't have an account?</span>
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
