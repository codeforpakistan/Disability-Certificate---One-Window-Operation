<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{ asset('img/nih-logo.png') }})"></span>
                <div class="d-none d-xl-block ps-2">
                    @php
                        $user = Auth::user();
                        $roles = $user->roles->pluck('name')->toArray();
                        $roles = implode(',', $roles);
                    @endphp
                    <div>{{ $user->name }}</div>
                    <div class="mt-1 small text-muted">{{ $roles }}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('Profile & account') }}</a>
                <div class="dropdown-divider"></div>
                <!-- Authentication -->
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">{{ __('Log out') }}</a>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
          </div>
        </div>
      </header>