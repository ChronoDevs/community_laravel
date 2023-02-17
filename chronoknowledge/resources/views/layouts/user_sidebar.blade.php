<!--Main Navigation-->
{{-- <button id="sidebarBtn" class="navbar-toggler position-sticky justify-end justify-content-end" style="top:10vh;left:12%" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars fa-2x"></i>
  </button> --}}
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse nav d-lg-block sidebar bg-transparent flex-column">
      <div class="position-sticky mt-5">
        <div  class="list-group list-group-flush mx-3 mt-4 bg-transparent py-4">
          <a
            href="{{ route('home') }}"
            class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'home' || str_contains(request()->url(), 'posts') ? 'active' : '' }}"
            aria-current="true"
          >
            <img src="{{ asset('storage/assets/home.svg')}}" class="mx-2" alt="Home">Home
          </a>
          <a href="{{ route('listing') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'listing' ? 'active' : '' }}">
            <img src="{{ asset('storage/assets/listing.svg')}}" class="mx-2" alt="Listing"><span>Listing</span>
          </a>
          <a href="{{ route('favorites.index') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'favorites' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/favorites.svg')}}" class="mx-2" alt="favorites"><span>Favorites</span></a
          >
          <a href="{{ route('team') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'team' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/team.svg')}}" class="mx-2" alt="Team"><span>Team</span></a
          >
          <a href="{{ route('faqs') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'faqs' ? 'active' : '' }}">
            <img src="{{ asset('storage/assets/faq.svg')}}" class="mx-2" alt="FAQS"><span>FAQs</span>
          </a>
          <a href="{{ route('about') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'about' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/about.svg')}}" class="mx-2" alt="About"><span>About</span></a
          >
          <a href="{{ route('guides') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'guides' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/guide.svg')}}" class="mx-2" alt="Guide"><span>Guides</span></a
          >
          <a href="{{ route('code') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'code' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/code.svg')}}" class="mx-2" alt="Code"><span>Code of Conduct</span></a
          >
          <a href="{{ route('privacy-policy') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'privacy-policy' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/privacy.svg')}}" class="mx-2" alt="Privacy"><span>Privacy Policy</span></a
          >
          <a href="{{ route('terms') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'terms' ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/term.svg')}}" class="mx-2" alt="Term"><span>Terms of Use</span></a
          >
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action py-2 ripple logout"
            ><img src="{{ asset('storage/assets/logout.svg')}}" class="mx-2" alt="Home"></i>Logout</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  <!--Main Navigation-->
<script>

</script>
