@extends('layouts.auth')
@section('content')
    <div class="container py-2 h-100 clearfix">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-2-strong border" style="border-radius: 1rem; background-color: #242526;">
                    <div class="card-body p-5 text-center">
                        <h3>Chronostep Community </h3>
                        <h6>Welcome to the amazing community of engineers in Chronostep Inc.</h6>
                        <div class="primary">
                            @if ($errors->any())
                                {{$errors}}
                            @endif
                        </div>
                        <div class="container mb-5 mt-2">
                            <a class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" href="{{ route('login.google') }}">
                                <i class="fab fa-google me-2"></i> Sign in with google</a>
                        </div>
                        <div class="container mt-4 mb-2">
                            <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
                            type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button>
                        <h6 class="mb-5">Have a password? Continue with your email address</h6>
                        </div>
                        <form action="{{ route('login') }}" class="form" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeEmailX-2" style="float:left">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email"/>
                            </div>
                            @error('email')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2" style="float:left">Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password"/>
                            </div>
                            @error('password')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" value="1" id="form1Example3" name="remember"/>&nbsp;&nbsp;
                                <label class="form-check-label" for="form1Example3"> Remember password </label>
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
