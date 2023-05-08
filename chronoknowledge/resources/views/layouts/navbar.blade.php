<nav id="nav" class="navbar navbar-expand-lg text-dark mt-0">
    <div class="container-fluid py-2 mt-0">
      <a class="navbar-brand ms-5 companyLogo" href="#"><img id="companyLogo" src="{{ asset('storage/assets/chronostep_logo.png') }}" alt="Chronostep Logo"
        loading="lazy" class="img-fluid me-5"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-2x"></i>
      </button>
      <div class="collapse navbar-collapse ms-3" id="navbarSupportedContent">
        <ul class="navbar-nav search me-auto mb-2" >
          <li class="nav-item">
            <form action="{{ auth()->check() && auth()->user()->role_id == 1
                ? route('admin.search')
                :  route('posts.search') }}" class="input-group w-auto my-auto d-sm-flex d-xs-flex ms-2 me-auto"
                method="POST">
                @csrf
                @method('POST')
                <input autocomplete="off" type="search" class="form-control form-control-lg rounded search input-dark "
                    placeholder="Search" style="width: 20vw;" name="search"
                    value="{{ old('search') ?? isset($keyword) ? $keyword : '' }}"
                    @if(auth()->check() && auth()->user()->role_id == 1) disabled @endif />
            </form>
          </li>
        </ul>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto me-5">
            @if(!auth()->check())
            <li class="nav-item my-auto ms-5 me-auto">
                <a href="{{ route('login') }}" class="text-decoration-none text-light login">
                    Login
                </a>
            </li>
          <li class="nav-item ms-5 me-auto">
            <button class="btn btn-dark signupNavBtn">
                <a href="{{ route('register') }}" class="text-decoration-none text-info signupNavBtnText">
                    Create Account
                </a>
            </button>
          </li>
          @else
          <li class="nav-item dropdown me-3">
            <!-- Login -->
            <a class="btn-lg text-info" style="
            position: relative;
            display: inline-block;
            border-radius: 2px;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-regular fa-bell fa-2x"></i>
                <span class="badge bg-danger rounded-circle" style=" position: absolute;
                top: -1px;
                right: -1px;
                color: white;">
                    {{ $notifications->count() ?? 0 }}
                </span>
            </a>
            <ul class="dropdown dropdown-menu dropdown-menu-end bg-dark dropdown-menu-end me-5" id="navbarNotificationContent" aria-labelledby="navbarDropdownMenuLink" style="width: 300px;height:20vh;overflow:scroll">
                @forelse ($notifications as $notification)
                <li class="dropdown-item text-wrap">
                    <a class="text-decoration-none text-info" href="{{ route('posts.show', $notification->post_id) }}">
                        {{ $notification->user->name . ' ' . $notification->notification_type . ' your post "' . $notification->post->title . '".'}}
                    </a>
                </li>
                @empty
                <li>No notification</li>
                @endforelse
            </ul>
          </li>
          <li class="nav-item me-3">
            <a href="{{ route('login') }}" class="text-decoration-none text-white login">
                <img src="{{ asset('storage/assets/avatar.png') }}" alt="avatar"
                    class="img-fluid rounded-circle me-1" width="55" height="auto">
            </a>
          </li>
          <li class="nav-item me-3 me-lg-1 my-auto">
            {{-- <button class="btn btn-dark border signupNavBtn"> --}}
                <a href="{{ route('register') }}" class="text-decoration-none text-info signupNavBtnText">
                    {{ auth()->user()->name }}
                </a>
            {{-- </button> --}}
        </li>
        @endif
        </ul>
      </div>
    </div>
  </nav>
