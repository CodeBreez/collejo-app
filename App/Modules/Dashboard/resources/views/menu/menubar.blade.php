<div id="navbar">

    <navbar :menus="{{Menu::getMenuBarItems(Auth::user())}}">

        <nav class="navbar navbar-expand-lg navbar-light bg-light nav-loader">
            <div class="logo" style="background-image: url({{asset(mix('/images/base-collejo.svg'))}})"></div>
            <a class="navbar-brand" href="#">
                <span class="brand-name">Collejo</span>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                <span class="nav-link">
                    <div class="preloader rounded-circle"></div>
                    <div class="preloader rounded"></div>
                </span>
                    </li>
                    <li class="nav-item active">
                <span class="nav-link">
                    <div class="preloader rounded-circle"></div>
                    <div class="preloader rounded"></div>
                </span>
                    </li>
                    <li class="nav-item active">
                <span class="nav-link">
                    <div class="preloader rounded-circle"></div>
                    <div class="preloader rounded"></div>
                </span>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                <span class="nav-link">
                    <div class="preloader rounded-circle"></div>
                    <div class="preloader rounded"></div>
                </span>
                    </li>
                    <li class="nav-item active">
                <span class="nav-link">
                    <div class="preloader rounded-circle"></div>
                    <div class="preloader rounded"></div>
                </span>
                    </li>
                </ul>
            </div>
        </nav>

    </navbar>
</div>
