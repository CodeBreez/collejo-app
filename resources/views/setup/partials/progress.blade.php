<div>

    <h2>{{ trans('collejo::setup.installing_inprogress') }}</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <h4>{{ trans('collejo::setup.installing') }}</h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 60%;">
                </div>
            </div>
        </li>
    </ul>


    <script type="text/javascript">
       $(function(){
            window.setInterval(function(){
                $.getJSON('/setup/run', function(response) {
                });
            }, 1000);
       });
    </script>
</div>