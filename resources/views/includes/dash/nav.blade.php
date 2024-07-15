<!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="#">
          <!-- <h3>Dashboard</h3> -->
        </a>
        <a class="navbar-brand brand-logo-mini" href="#">
          <!-- <img src="images/logo-mini.svg" alt="logo" /> -->
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top"> 
      <!-- <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">John Doe</span></h1>
          <h3 class="welcome-sub-text">Your performance summary this week </h3>
        </li>
      </ul> -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="btn btn-dark btn-rounded btn-fw" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->name }}</a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            
           
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();" class="dropdown-item">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
<!-- partial -->