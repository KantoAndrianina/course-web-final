  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Ultimate Team Race</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteName() == 'details.liste_etape' ? 'active' : '' }}" aria-current="page" href="{{ route('details.liste_etape') }}">Etapes</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle {{ in_array(Route::currentRouteName(), ['classementGEtape.front', 'classementGEquipe.front']) ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Classement
              </a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item {{ Route::currentRouteName() == 'classementGEtape.front' ? 'active' : '' }}" href="{{ route('classementGEtape.front') }}">par étape</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item {{ Route::currentRouteName() == 'classementGEquipe.front' ? 'active' : '' }}" href="{{ route('classementGEquipe.front') }}">par équipe</a></li>
              </ul>
          </li>
      </ul>
        <form id="logout-equipe-form" action="{{ route('logout.equipe') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="{{ route('logout.equipe') }}" class="btn btn-outline-light"
          onclick="event.preventDefault(); 
                    document.getElementById('logout-equipe-form').submit();">
            Log Out
        </a>
      </div>
    </div>
  </nav>
