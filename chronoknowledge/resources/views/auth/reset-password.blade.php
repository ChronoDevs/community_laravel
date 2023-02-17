@extends('layouts.auth')
@section('content')
    <div class="container py-2 clearfix">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-2-strong border">
                    <div class="card-body p-5 text-center">
                        <h3 class="text-light header">Reset Password </h3>
                        <form action="{{ route('password.update') }}" class="form" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->token }}">
                            <div class="form-outline mb-4">
                                <label class="form-label text-light" for="typeEmailX-2" style="float:left">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg input-dark" name="email" readonly value="{{ request()->email }}"/>
                            </div>
                            @error('email')
                                <span class="text text-danger mb-1">{{ $message }}</span><br>
                            @enderror
                            <div class="form-outline mb-4">
                                <label class="form-label text-light" for="typePasswordX-2" style="float:left">Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg input-dark" name="password" value="{{ old('password')}}"/>
                            </div>
                            @error('password')
                                <span class="text text-danger mb-1">{{ $message }}</span><br>
                            @enderror
                            <div class="form-outline mb-4">
                                <label class="form-label text-light" for="typePasswordX-2" style="float:left">Confirm Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg input-dark" name="password_confirmation" value="{{ old('password_confirmation')}}"/>
                            </div>
                            @error('password_confirmation')
                                <span class="text text-danger mb-2">{{ $message }}</span>
                            @enderror
                            <button class="btn btn-primary btn-lg w-100 mt-2" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
