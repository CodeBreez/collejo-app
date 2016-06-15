<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-main-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand brand-text"><img src="{{ Asset::getVersionedFile('/images/collejo_sml.png') }}"> <span>Collejo</span></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-main-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Students <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/dash/students">List All</a>
                        </li>
                    </ul>
                </li>
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

{{ dd(new Theme()) }}

{{ dd(Route::getRoutes()) }}
