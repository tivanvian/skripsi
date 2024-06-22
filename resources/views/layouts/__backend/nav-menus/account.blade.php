<li class="profile-nav onhover-dropdown pe-0 py-0">
    <div class="media profile-media">
        <img class="b-r-10" src="{{ (Auth::user()->UserPhoto() != null || Auth::user()->UserPhoto() != '') ? Storage::url("profile/".Auth::user()->UserPhoto()) : asset("backend/assets/imgs/people/avatar-2.png") }}" width="35px" alt="">
        <div class="media-body"><span>{{ Auth::user()->name }}</span>
            <p class="mb-0 font-roboto">{{ Auth::user()->email }} <i class="middle fa fa-angle-down"></i></p>
        </div>
    </div>
    <ul class="profile-dropdown onhover-show-div">
         <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
        <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"> </i><span>Log Out</span></a></li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
