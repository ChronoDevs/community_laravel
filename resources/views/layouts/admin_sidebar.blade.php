<!--Main Navigation-->
<header id="main">
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-transparent">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4 bg-transparent py-4">
          <a
            href="{{ route('admin.dashboard') }}"
            class="list-group-item list-group-item-action py-2 ripple active"
            aria-current="true"
          >
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
          </a>
          <a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-bar fa-fw me-3"></i><span>Tags</span></a>
          <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-globe fa-fw me-3"></i><span>Categories</span></a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-money-bill fa-fw me-3"></i>Logout</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  </header>


