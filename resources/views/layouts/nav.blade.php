@auth
    @if($_SERVER['SERVER_NAME'] == 'sysacc.netver.niel' || $_SERVER['SERVER_NAME'] == 'sysacc.netver.com')
    <?php $menus = App\Menu::orderBy('order')->get(); ?>
        <?=Menu::new()
            ->addClass('nav navbar-nav')
            ->route('home', '<strong class="text-white"><span class="glyphicon glyphicon-home"></span></strong>')
            ->setActiveFromRequest();?>
        <ul class="nav navbar-nav">
            <?php foreach($menus as $menu) : ?>
                @if($menu->roles()->whereIn('role_id',Auth::user()->roles->pluck('id'))->count() && (Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') || $menu->menu_set->groups()->where('group_id',Auth::user()->groups->first()->id)->count()))

                    <li class="{{$menu->parent($menu['id'],Request::segment(1)) || Request::segment(1) == $menu['link'] ? 'active':''}}">
                        @if(($menu['company_related'] && session('selected-company')) || (!$menu['company_related']))
                            @if($menu['has_children'] && $menu['parent_id'] == '')
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <strong class="text-white">
                                        @if($menu['name'] == 'Start')
                                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                                        @else
                                            {{$menu['name']}}
                                            <span class="caret"></span>
                                        @endif
                                    </strong>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach($menu->children($menu['id'])->orderBy('order')->get() as $child) : ?>
                                        @if($child->roles()->whereIn('role_id',Auth::user()->roles->pluck('id'))->count() && (Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') || $child->menu_set->groups()->where('group_id',Auth::user()->groups->first()->id)->count()))
                                            @if(($child['company_related'] && session('selected-company')) || (!$child['company_related']))
                                                @if($child['has_children'])

                                                    <li class="dropdown-submenu {{$child->parent($child['id'],Request::segment(1)) ? 'active':''}}">

                                                        <a class="test" tabindex="-1" href="#"><strong>{{$child['name']}} <span class="caret-right"></span></strong></a>
                                                        <ul class="dropdown-menu">
                                                            <?php foreach($child->children($child['id'])->orderBy('order')->get() as $child1) : ?>
                                                                @if($child1->roles()->whereIn('role_id',Auth::user()->roles->pluck('id'))->count() && (Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') || $child1->menu_set->groups()->where('group_id',Auth::user()->groups->first()->id)->count()))
                                                                    @if(($child1['company_related'] && session('selected-company')) || (!$child1['company_related']))
                                                                        @if($child1['has_children'])

                                                                            <li class="dropdown-submenu {{$child1->parent($child1['id'],Request::segment(1)) ? 'active':''}}">

                                                                                <a class="test" tabindex="-1" href="#">{{$child1['name']}} <span class="caret-right"></span></a>
                                                                                <ul class="dropdown-menu">
                                                                                    <?php foreach($child1->children($child1['id'])->orderBy('order')->get() as $child2) : ?>
                                                                                        @if($child2->roles()->whereIn('role_id',Auth::user()->roles->pluck('id'))->count() && (Auth::user()->hasRole('system admin') || Auth::user()->hasRole('super admin') || $child2->menu_set->groups()->where('group_id',Auth::user()->groups->first()->id)->count()))
                                                                                            @if(($child2['company_related'] && session('selected-company')) || (!$child2['company_related']))
                                                                                                @if($child2['has_children'])

                                                                                                    <li class="dropdown-submenu {{$child2->parent($child2['id'],Request::segment(1)) ? 'active':''}}">

                                                                                                        <a class="test" tabindex="-1" href="#">{{$child2['name']}} <span class="caret-right"></span></a>
                                                                                                        <ul class="dropdown-menu">
                                                                                                            <?php foreach($child2->children($child2['id'])->orderBy('order')->get() as $child3) : ?>

                                                                                                                <li class="{{$child3['link'] == Request::segment(1) ? 'active':''}}">

                                                                                                                    <a tabindex="-1" href="/{{$child3['link']}}">{{$child3['name']}}</a>
                                                                                                                </li>
                                                                                                            <?php endforeach; ?>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                @else
                                                                                                    <li class="{{$child2['link'] == Request::segment(1) ? 'active':''}}">
                                                                                                        <a tabindex="-1" href="/{{$child2['link']}}">{{$child2['name']}}</a>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    <?php endforeach; ?>
                                                                                </ul>
                                                                            </li>
                                                                        @else
                                                                            <li class="{{$child1['link'] == Request::segment(1) ? 'active':''}}">
                                                                                <a tabindex="-1" href="/{{$child1['link']}}">{{$child1['name']}}</a>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li class="{{$child['link'] == Request::segment(1) ? 'active':''}}">
                                                        <a href="/{{$child['link']}}"><strong>{{$child['name']}}</strong></a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endif
                                    <?php endforeach; ?>
                                </ul>
                            @elseif($menu['parent_id'] == '')
                                <a href="/{{$menu['link']}}">
                                    <strong class="text-white">{{$menu['name']}}</strong>
                                </a>
                            @endif
                        @endif
                    </li>
                @endif
            <?php endforeach; ?>
        </ul>
    @else
        <?=Menu::new()
            ->addClass('nav navbar-nav')
            ->route('accountant.profile', '<strong class="text-white">Home</strong>')
            ->setActiveFromRequest();?>
    @endif
@endauth
<ul class="nav navbar-nav navbar-right">
    @guest
        <li class="hidden"><a href="{{ route('login') }}">Login</a></li>
        <li class="hidden"><a href="{{ route('register') }}">Register</a></li>
    @else
        @if (Auth::check())
            <li>
                <a nohref style="cursor: pointer; padding-bottom: 0;">
                    <strong class="text-white">{{auth()->user()->full_name}}</strong>
                </a>
                @if($company = App\Company::find(session('selected-company')) && (Request::segment(1) != 'company-fiscal-periods' || (Request::segment(1) == 'company-fiscal-periods' && Request::segment(2) == 'select')))
                <a nohref style="cursor: pointer; padding-bottom: 0; padding-top: 0;">
                    <strong class="text-white">{{App\Company::find(session('selected-company'))->trade_name}}</strong>
                </a>
                @endif
                @if(session('selected-company-fiscal-period'))
                <a nohref style="cursor: pointer; padding-top: 0;">
                    <strong class="text-white">Fiscal Year End: {{session('selected-company-fiscal-period')->end_date->format('F j, Y')}}</strong>
                </a>
                @endif
            </li>
            <li class="hidden">
                <a class="text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <strong class="text-white">Logout</strong>
                </a>
            </li>
        @endif
        <li class="dropdown hidden">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    @endguest
</ul>
