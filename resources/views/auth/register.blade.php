@extends('layouts.auth')
@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-2 p-md-5">
                        <h3>Chronostep Community </h3>
                        <h6>Welcome to the amazing community of engineers in Chronostep Inc.</h6>

                        <button class="btn btn-lg btn-block btn-primary w-100 mt-2 mb-2" style="background-color: #dd4b39;"
                            type="submit">
                            <i class="fab fa-google me-2"></i> Sign in with google</button>
                        <button class="btn btn-lg btn-block btn-primary mb-2 w-100 mt-2 mb-2"
                            style="background-color: #3b5998;" type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in
                            with facebook</button>
                        <div class="container-fluid mt-4 mb-3">
                            <div class="mb-2"> Already have an account? &nbsp;&nbsp;
                                <a href="{{ route('login') }}">Log in.</a>
                            </div>
                        </div>
                        <form class="px-md-2" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="firstName">First Name</label>
                                <input type="text" id="firstName" class="form-control form-control-lg"
                                    value="{{ old('first_name') }}" name="first_name" placeholder="First Name" />
                            </div>
                            @error('first_name')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="form3Example1w">Middle Name (optional)</label>
                                <input type="text" id="middleName" class="form-control form-control-lg"
                                    value="{{ old('middle_name') }}" name="middle_name" placeholder="Middle Name" />
                            </div>
                            @error('middle_name')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label float-left" for="lastName">Last Name</label>
                                <input type="text" id="lastName" class="form-control form-control-lg"
                                    value="{{ old('last_name') }}" name="last_name" placeholder="Last Name" />
                            </div>
                            @error('last_name')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="row">
                                <div class="col-md-6 mb-1 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="username" id="username" class="form-control form-control-lg"
                                            value="{{ old('username') }}" name="username" placeholder="Username" />
                                        @error('username')
                                            <span class="text text-danger mb-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label float-left" for="nickName">Nickname</label>
                                        <input type="tel" id="nickName" class="form-control form-control-lg"
                                            value="{{ old('nick_name') }}" name="nick_name" placeholder="Nickname" />
                                        @error('nick_name')
                                            <span class="text text-danger mb-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1 pb-2">
                                    <label class="form-label float-left" for="gender">Gender</label>
                                    <select class="select form-control form-control-lg" value="{{ old('gender') }}" name="gender">
                                        <option value="" selected>Select Gender</option>
                                        <option value="1">Female</option>
                                        <option value="2">Male</option>
                                        <option value="3">Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="text text-danger mb-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-1 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label float-left" for="dateOfBirth">Date of Birth</label>
                                        <input type="tel" id="dateOfBirth" class="form-control form-control-lg"
                                            value="{{ old('date_of_birth') }}" name="date_of_birth"
                                            placeholder="mm-dd-yyyy" />
                                        @error('date_of_birth')
                                            <span class="text text-danger mb-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="contactNumber">Contact Number</label>
                                        <input type="text" id="contactNumber" class="form-control form-control-lg"
                                            value="{{ old('contact_number') }}" name="contact_number"
                                            placeholder="Contact Number" />
                                        @error('contact_number')
                                            <span class="text text-danger mb-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label float-left" for="zipCode">Zip Code</label>
                                        <input type="tel" id="zipCode" class="form-control form-control-lg"
                                            value="{{ old('zip_code') }}" name="zip_code"
                                            placeholder="Zip Code" />
                                        @error('zip_code')
                                            <span class="text text-danger mb-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline mb-1">
                                <label class="form-label" for="address" style="float:left">Address</label>
                                <input type="address" id="address" class="form-control form-control-lg" value="{{ old('address') }}" name="address"
                                    placeholder="Address" />
                            </div>
                            @error('address')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label" for="typeEmailX-2" style="float:left">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" value="{{ old('email') }}"
                                    name="email" placeholder="Email" />
                            </div>
                            @error('email')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label" for="typePasswordX-2" style="float:left">Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" value="{{ old('password') }}"
                                    name="password" placeholder="Password" />
                            </div>
                            @error('password')
                                <span class="text text-danger mb-1">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2" style="float:left">Confirm Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password_confirmation" value="{{ old('password_confirmation')}}" placeholder="Confirm Password"/>
                            </div>
                            @error('password_confirmation')
                                <span class="text text-danger mb-2">{{ $message }}</span>
                            @enderror
                            <div class="form-outline mb-1">
                                <label class="form-label" for="profile" style="float:left">Profile</label>
                                <input type="file" id="profile" class="form-control form-control-lg" name="profile" value="{{ old('profile')}}" placeholder="Profile"/>
                            </div>
                            @error('profile')
                                <span class="text text-danger mb-4">{{ $message }}</span>
                            @enderror
                            <button class="btn btn-primary btn-lg w-100 mt-4" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // jQuery.noConflict();
        $(document).ready(function() {
            $('#dateOfBirth').datepicker({
                dateFormat: "mm-dd-yy"
            });
        })
    </script>
@endsection
