<li class="language-nav">
    <div class="translate_wrapper">
      <div class="current_lang">
        <div class="lang">
            @if(Config::get('languages')[App::getLocale()] == 'English')
                <i class="flag-icon flag-icon-us"></i>
                <span class="lang-txt">EN</span>
            @elseif(Config::get('languages')[App::getLocale()] == 'Bahasa')
                <i class="flag-icon flag-icon-id"></i>
                <span class="lang-txt">ID</span>
            @endif
        </div>
      </div>
      <div class="more_lang">
        <div class="lang @if(Config::get('languages')[App::getLocale()] == 'English') selected @endif" data-value="en" id="changeLangEN">
            <i class="flag-icon flag-icon-us"></i>
            <span class="lang-txt">English<span> (US)</span></span>
        </div>
        <div class="lang @if(Config::get('languages')[App::getLocale()] == 'Bahasa') selected @endif" data-value="id" id="changeLangID">
            <i class="flag-icon flag-icon-id"></i>
            <span class="lang-txt">Bahasa<span> (ID)</span></span>
        </div>
        {{-- <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
        <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
        <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
        <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
        <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div> --}}
      </div>
    </div>
  </li>
