<!--Main Navigation-->
<header id="main">
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-transparent">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 bg-transparent py-4">
          <a
            href="{{ route('admin.dashboard') }}"
            class="list-group-item list-group-item-action py-2 ripple {{ last(explode('/', request()->url())) == 'admin' ? 'active' : '' }}"
            aria-current="true"
          >
          <img src="{{ asset('storage/assets/home.svg')}}" class="mx-2" alt="Home"><span>Dashboard</span>
          </a>
          <a href="{{ route('admin.posts') }}" class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->url(), 'posts') ? 'active' : '' }}">
            <img src="{{ asset('storage/assets/listing.svg')}}" class="mx-2" alt="Listing"><span>Manage Posts</span></a>
          <a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->url(), 'tags') ? 'active' : '' }}">
            <img src="{{ asset('storage/assets/favorites.svg')}}" class="mx-2" alt="favorites"><span>Tags</span></a>
          <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->url(), 'categories') ? 'active' : '' }}"
            ><img src="{{ asset('storage/assets/about.svg')}}" class="mx-2" alt="About"><span>Categories</span></a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-danger list-group-item list-group-item-action py-2 ripple"
            ><img src="{{ asset('storage/assets/logout.svg')}}" class="mx-2">Logout</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  </header>
