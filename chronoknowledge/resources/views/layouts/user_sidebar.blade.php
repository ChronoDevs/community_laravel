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
            <i class="fas fa-tachometer-alt fa-fw me-3"></i>Home
          </a>
          <a href="{{ route('listing') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'listing' ? 'active' : '' }}">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Listing</span>
          </a>
          <a href="{{ route('favorites.index') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'favorites' ? 'active' : '' }}"
            ><i class="fas fa-lock fa-fw me-3"></i><span>Favorites</span></a
          >
          <a href="{{ route('team') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'team' ? 'active' : '' }}"
            ><i class="fas fa-chart-line fa-fw me-3"></i><span>Team</span></a
          >
          <a href="{{ route('faqs') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'faqs' ? 'active' : '' }}">
            <i class="fas fa-chart-pie fa-fw me-3"></i><span>FAQs</span>
          </a>
          <a href="{{ route('about') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'about' ? 'active' : '' }}"
            ><i class="fas fa-chart-bar fa-fw me-3"></i><span>About</span></a
          >
          <a href="{{ route('guides') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'guides' ? 'active' : '' }}"
            ><i class="fas fa-globe fa-fw me-3"></i><span>Guides</span></a
          >
          <a href="{{ route('code') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'code' ? 'active' : '' }}"
            ><i class="fas fa-building fa-fw me-3"></i><span>Code of Conduct</span></a
          >
          <a href="{{ route('privacy-policy') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'privacy-policy' ? 'active' : '' }}"
            ><i class="fas fa-calendar fa-fw me-3"></i><span>Privacy Policy</span></a
          >
          <a href="{{ route('terms') }}" class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'terms' ? 'active' : '' }}"
            ><i class="fas fa-users fa-fw me-3"></i><span>Terms of Use</span></a
          >
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action py-2 ripple logout"
            ><i class="fas fa-money-bill fa-fw me-3"></i>Logout</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  <!--Main Navigation-->
<script>

</script>
