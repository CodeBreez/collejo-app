<div>

    <h2>{{ trans('collejo::setup.installing_inprogress') }}</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <h4 id="status">{{ trans('collejo::setup.installing') }}</h4>
            <div class="progress">
                <div class="progress-bar" id="progress" role="progressbar" style="width: 0;">
                </div>
            </div>
        </li>
    </ul>


    <script type="text/javascript">
       $(function(){
            runStep('/setup/run');
       });

       function runStep($url) {

            window.setTimeout(function(){
                
                $.getJSON($url, function(response) {
                    $('#status').text(response.data.status);
                    $('#progress').css({width:response.data.progress + '%'});

                    if (response.data.next === false) {
                        $.getJSON('/setup/done', function(response) {
                            $('#content').empty().append(response.data.html);
                        });
                    } else {
                        runStep('/setup/run/' + response.data.next);
                    }

                });
            }, 1000);
       }
    </script>
</div>