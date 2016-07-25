<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-main-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand brand-text"><img src="{{ asset(elixir('/images/collejo_sml.png')) }}"> <span>Collejo</span></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-main-navbar-collapse">
            <ul class="nav navbar-nav">

                @foreach (Menu::getMenuBarItems()->sortBy('order') as $item)

                    @if($item->isVisible())

                        @if($item->children->count())

                            <li class="dropdown">
                                <a href="{{ $item->getFullPath() }}" class="dropdown-toggle" data-toggle="dropdown"><i class="fa {{ $item->getIcon() }}"></i> {{ $item->getLabel() }} <b class="caret"></b></a>

                                <ul class="dropdown-menu">

                                    @foreach($item->children->sortBy('order') as $child1)

                                        @if($child1->isVisible())

                                            @if($child1->children->count() && is_null($child1->getLabel()))

                                                <li role="separator" class="divider"></li>

                                                @foreach($child1->children->sortBy('order') as $child2)

                                                    @if($child2->isVisible())

                                                        <li><a href="{{ $child2->getFullPath() }}">{{ $child2->getLabel() }}</a></li>

                                                    @endif

                                                @endforeach

                                            @else

                                                <li><a href="{{ $child1->getFullPath() }}">{{ $child1->getLabel() }}</a></li>

                                            @endif

                                        @endcan

                                    @endforeach

                                </ul>
                            </li>

                        @else

                            <li><a href="{{ $item->getFullPath() }}"><i class="fa {{ $item->getIcon() }}"></i> {{ $item->getLabel() }}</a></li>

                        @endif

                    @endcan

                @endforeach

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/my/account">Account</a>
                        </li>
                        <li>
                            <a href="/auth/logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>