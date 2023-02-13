<!-- Navbar -->
<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid" >
        <!-- Toggle button -->
        {{-- <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button> --}}

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse pe-5" id="navbarSupportedContent" style="display: flex;justify-content: space-between;">
            <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    <img id="companyLogo" src="{{ asset('storage/assets/chronostep_logo.png') }}" alt="Chronostep Logo"
                        loading="lazy" class="img-fluid me-5" />
                </a>
                <!-- Search form -->
                <form action="{{ route('posts.search') }}" class="input-group w-auto my-auto d-none d-sm-flex ms-2" style="margin-right:auto"
                    method="POST">
                    @csrf
                    @method('POST')
                    <input autocomplete="off" type="search" class="form-control form-control-lg rounded me-4 search ms-5"
                        placeholder="Search" style="width: 20vw;" name="search"
                        value="{{ old('search') ?? isset($keyword) ? $keyword : '' }}" />
                </form>
                <!-- Collapsible wrapper -->

            @if(!auth()->check())
            <!-- Center elements -->
            <ul class="navbar-nav me-5">
                <li class="nav-item me-3 me-lg-1 my-auto me-5">
                    <!-- Login -->
                    <a href="{{ route('login') }}" class="text-decoration-none text-white login">
                        Login
                    </a>
                </li>
                {{-- <li class="nav-item me-3 me-lg-1">
                    <button class="btn btn-dark border">
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                            Create Account
                        </a>
                    </button>
                </li> --}}
            </ul>
            <!-- Center elements -->

            <!-- Right elements -->
            <ul class="navbar-nav flex-row me-5">
                <!-- Create Account -->
                <li class="nav-item me-3 me-lg-1">
                    <button class="btn btn-dark border signupNavBtn">
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary signupNavBtnText">
                            Create Account
                        </a>
                    </button>
                </li>
            </ul>
            <!-- Right elements -->
            @else
                <!-- Center elements -->
            <ul class="navbar-nav me-2">
                <li class="nav-item me-3 my-auto">
                    <!-- Login -->
                    <button class="btn text-decoration-none text-white login">
                        <i class="fa fa-bell"><span class="badge badge-light">4</span></i>

                    </button>
                </li>
                <li class="nav-item me-3 me-lg-1 my-auto me-2">
                    <!-- Login -->
                    <a href="{{ route('login') }}" class="text-decoration-none text-white login">
                        <img src="{{ asset('storage/assets/avatar.png') }}" alt="avatar"
                            class="img-fluid rounded-circle me-1" width="55" height="auto">
                    </a>
                </li>
                {{-- <li class="nav-item me-3 me-lg-1">
                    <button class="btn btn-dark border">
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                            Create Account
                        </a>
                    </button>
                </li> --}}
            </ul>
            <!-- Center elements -->

            <!-- Right elements -->
            <ul class="navbar-nav flex-row me-5">
                <!-- Create Account -->
                <li class="nav-item me-3 me-lg-1">
                    {{-- <button class="btn btn-dark border signupNavBtn"> --}}
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary signupNavBtnText">
                            {{ auth()->user()->name }}
                        </a>
                    {{-- </button> --}}
                </li>
            </ul>
            @endif
        </div>

    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
