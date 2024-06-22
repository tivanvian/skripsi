<li class="dropdown nav-item">
    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{ (Auth::user()->UserPhoto() != null || Auth::user()->UserPhoto() != '') ? Storage::url("profile/".Auth::user()->UserPhoto()) : asset("backend/assets/imgs/people/avatar-2.png") }}" alt="User" /></a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
        <a class="dropdown-item" href="#"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="material-icons md-exit_to_app"></i>Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
