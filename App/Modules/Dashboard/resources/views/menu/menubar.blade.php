<div id="navbar">
    <navbar :menus="{{Menu::getMenuBarItems(Auth::user())}}"></navbar>
</div>
