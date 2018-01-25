<script>
    window.C.menus = {!! json_encode(Menus::getMenuBarItems(), JSON_PRETTY_PRINT) !!};
</script>

<div id="navbar">
    <navbar></navbar>
</div>
