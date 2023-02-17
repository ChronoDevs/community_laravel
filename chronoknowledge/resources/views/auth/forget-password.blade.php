@extends('layouts.auth')
@section('content')
    <div class="container py-2 clearfix">
        <div class="row d-flex justify-content-center align-items-center my-auto">
            <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-2-strong border">
                    <div class="card-body p-5 text-center">
                        <h3 class="text-light">Forgot Password? </h3>
                        <h6 class="text-light">Enter your registered email address to this amazing opportunity.</h6>
                        <form action="{{ route('password.email') }}" class="form mt-5" method="POST">
                            @csrf
                            <div class="form-outline mb-4 mt-5">
                                <label class="form-label text-light" for="typeEmailX-2" style="float:left">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg input-dark" name="email" value="{{ old('email') }}"/>
                            </div>
                            @error('email')
                                <span class="text text-danger mb-2 float-left">{{ $message }}</span>
                            @enderror
                            <div class="container my-4 pt-2">
                                <span class="text-light me-4">━━</span>
                                <span class="text-muted">Don't have an account?
                                    <a href="{{ route('register.index') }}">Create an account</a>
                                </span>
                                <span class="text-light ms-4">━━</span>
                            </div>
                            <button class="btn btn-primary btn-lg w-100" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
