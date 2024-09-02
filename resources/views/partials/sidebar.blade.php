<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @auth
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                        <span class="login-status online"></span>
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                        <span class="text-secondary text-small">Project Manager</span>
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
        @endauth
        <!-- Project Links -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/user') }}">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/permission') }}">
                <span class="menu-title">Permissions </span>
                <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/role') }}">
                <span class="menu-title">Roles</span>
                <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/product') }}">
                <span class="menu-title">Products</span>
                <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
