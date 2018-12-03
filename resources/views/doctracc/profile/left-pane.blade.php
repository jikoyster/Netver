<div class="m-portlet m-portlet--full-height  ">
    <div class="m-portlet__body">
    @foreach ($users as $key => $data)
        <div class="m-card-profile">
            <div class="m-card-profile__title m--hide">
                Your Profile
            </div>
            <div class="m-card-profile__pic">
                <div class="m-card-profile__pic-wrapper">
                    <img src="../assets/doctracc/assets/app/media/img/users/user4.jpg" alt="">
                </div>
            </div>
            <div class="m-card-profile__details">
                <span class="m-card-profile__name">
                    {{$data->first_name}} {{$data->last_name}}
                </span>
                <a href="" class="m-card-profile__email m-link">{{ $data->email }}</a>
            </div>
        </div>
        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
            <li class="m-nav__separator m-nav__separator--fit"></li>
            <li class="m-nav__section m--hide">
                <span class="m-nav__section-text">Section</span>
            </li>

            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                    <span class="m-nav__link-title">
                        <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text">My Profile</span>
                            <span class="m-nav__link-badge">
                                <span class="m-badge m-badge--success">2</span>
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-share"></i>
                    <span class="m-nav__link-text">Activity</span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                    <span class="m-nav__link-text">Messages</span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-graphic-2"></i>
                    <span class="m-nav__link-text">Sales</span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-time-3"></i>
                    <span class="m-nav__link-text">Events</span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                    <span class="m-nav__link-text">Support</span>
                </a>
            </li>
        </ul>
    @endforeach
    </div>
</div>