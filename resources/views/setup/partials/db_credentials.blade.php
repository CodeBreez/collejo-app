<div>

    <h2>{{ trans('collejo::setup.db_credentials') }}</h2>

    <form method="POST" action="/setup/db" id="db-credentials-form">
        <ul class="list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-7">
                        <label>{{ trans('collejo::setup.host') }}</label>  
                        <p>{{ trans('collejo::setup.host_help') }}</p> 
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="host" placeholder="localhost" value="localhost">
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-7">
                        <label>{{ trans('collejo::setup.port') }}</label>  
                        <p>{{ trans('collejo::setup.port_help') }}</p> 
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="port" placeholder="3306" value="3306">
                    </div>
                </div>
            </li>           
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-7">
                        <label>{{ trans('collejo::setup.database') }}</label>  
                        <p>{{ trans('collejo::setup.database_help') }}</p> 
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="db" placeholder="collejo" value="collejo">
                    </div>
                </div>
            </li>            
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-7">
                        <label>{{ trans('collejo::setup.db_username') }}</label>  
                        <p>{{ trans('collejo::setup.db_username_help') }}</p> 
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="u" class="form-control">
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-7">
                        <label>{{ trans('collejo::setup.db_password') }}</label>  
                        <p>{{ trans('collejo::setup.db_password_help') }}</p> 
                    </div>
                    <div class="col-md-5">
                        <input type="password" name="p" class="form-control">
                    </div>
                </div>
            </li>
        </ul>

        <button type="submit" class="btn btn-lg btn-success pull-right">{{ trans('collejo::common.continue') }}</button>
    </form>

    <script type="text/javascript">
        $('#db-credentials-form').validate({
            rules:{
                host:{
                    required:true
                },
                port:{
                    required:true
                },
                db:{
                    required:true
                },
                u:{
                    required:true
                },
                p:{
                    required:true
                }
            },
            submitHandler:function(form){
                $(form).ajaxSubmit({
                    beforeSubmit:collejo.lockForm(form),
                    success:function(response){
                        if (response.success) {
                            $('#content').empty().append(response.data.html);
                        } else {
                            collejo.unlockForm(form);
                        }
                    }, error:function(){
                        collejo.unlockForm(form);
                    }
                });
            }
        })
    </script>
</div>