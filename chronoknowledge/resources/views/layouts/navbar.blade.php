<!-- Navbar -->
<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid justify-content-between">
        {{-- <!-- Left elements -->
    <div class="d-flex">
        <!-- Brand -->
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="#">
          <img
            src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
            height="20"
            alt="MDB Logo"
            loading="lazy"
            style="margin-top: 2px;"
          />
        </a>

        <!-- Search form -->
        <form class="input-group w-auto my-auto d-none d-sm-flex">
          <input
            autocomplete="off"
            type="search"
            class="form-control rounded"
            placeholder="Search"
            style="min-width: 125px;"
          />
          <span class="input-group-text border-0 d-none d-lg-flex"
            ><i class="fas fa-search"></i
          ></span>
        </form>
      </div>
      <!-- Left elements --> --}}
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img id="companyLogo" src="{{ asset('storage/assets/chronostep_logo.png') }}" alt="Chronostep Logo"
                    loading="lazy" class="img-fluid me-5"/>
            </a>
            <!-- Search form -->
            <form action="{{ route('posts.search') }}" class="input-group w-auto my-auto d-none d-sm-flex" method="POST">
                @csrf
                @method('POST')
                <input autocomplete="off" type="search" class="form-control form-control-lg rounded me-4 search ms-5"
                    placeholder="Search" style="width: 20vw;" name="search" value="{{ old('search') ?? isset($keyword) ? $keyword : '' }}" />
            </form>
        </div>
        <!-- Collapsible wrapper -->

        <!-- Center elements -->
        <ul class="navbar-nav flex-row d-none d-md-flex">
            <li class="nav-item me-3 me-lg-1">
                <!-- Login -->
                <a href="{{ route('login') }}" class="text-decoration-none text-white">
                    Login
                </a>
            </li>
        </ul>
        <!-- Center elements -->

        <!-- Right elements -->
        <ul class="navbar-nav flex-row">
            <!-- Create Account -->
            <li class="nav-item me-3 me-lg-1">
                <button class="btn btn-dark border">
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                        Create Account
                    </a>
                </button>
            </li>
        </ul>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
