<header class="main-header navbar">
    <div class="col-search">
        <form class="searchform">
            <div class="input-group">
   
                <select class="form-select" id="session_roles" name="session_roles">
                    @foreach(OptionSessionRole() as $value)
                        <option value="{{ $value }}" @if($value == session('default_role')) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                {{-- {!! FormSelect("Default Role", 'default_role', "-- Chose Role --", $roles, false, session('default_role')) !!} --}}
            </div>
            {{-- <div class="input-group">
                <input list="search_terms" type="text" class="form-control" placeholder="Search term" />
                <button class="btn btn-light bg" type="button"><i class="material-icons md-search"></i></button>
            </div> --}}
            {{-- <datalist id="search_terms">
                <option value="Products"></option>
                <option value="New orders"></option>
                <option value="Apple iphone"></option>
                <option value="Ahmed Hassan"></option>
            </datalist> --}}
        </form>
    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn-icon" href="#">
                    <i class="material-icons md-notifications animation-shake"></i>
                    <span class="badge rounded-pill">3</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
            </li>
            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false"><i class="material-icons md-public"></i></a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                    <a class="dropdown-item text-brand" href="#"><img src="{{asset('backend/assets/imgs/theme/flag-us.png') }}" alt="English" />English</a>
                    <a class="dropdown-item" href="#"><img src="{{asset('backend/assets/imgs/theme/flag-fr.png') }}" alt="Français" />Français</a>
                    <a class="dropdown-item" href="#"><img src="{{asset('backend/assets/imgs/theme/flag-jp.png') }}" alt="Français" />日本語</a>
                    <a class="dropdown-item" href="#"><img src="{{asset('backend/assets/imgs/theme/flag-cn.png') }}" alt="Français" />中国人</a>
                </div>
            </li> --}}
            @include('layouts.backend.header.account')
        </ul>
    </div>
</header>
