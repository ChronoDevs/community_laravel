@extends('layouts.auth')
@section('content')
    <div class="container py-2 h-100 clearfix">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-2-strong border" style="border-radius: 1rem; background-color:white;">
                    <div class="card-body p-5 text-center">
                        <h3>Forgot Password? </h3>
                        <form action="{{ route('password.email') }}" class="form" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeEmailX-2" style="float:left">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email" value="{{ old('email') }}"/>
                            </div>
                            @error('email')
                                <span class="text text-danger mb-2 float-left">{{ $message }}</span>
                            @enderror
                            <button class="btn btn-primary btn-lg w-100" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
