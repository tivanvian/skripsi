<li class="profile-nav onhover-dropdown pe-0 py-0" style="margin-right:20px;">
    <div class="media profile-media">
        <p class="mb-0 font-roboto">{{ session('default_role') }} <i class="middle fa fa-angle-down"></i></p>
    </div>
    <ul class="profile-dropdown onhover-show-div">
        @foreach(OptionSessionRole() as $value)
            <li><a href="javascript:;" data-role="{{ $value }}" onclick="changeRole('{{$value}}')"><span>{{ $value }} </span></a></li>
        @endforeach
    </ul>
</li>

