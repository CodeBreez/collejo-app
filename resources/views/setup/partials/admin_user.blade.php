<div>

    <h2>{{ trans('collejo::setup.create_admin_account') }}</h2>

    <form method="POST" action="/setup/admin" id="db-credentials-form">
        <ul class="list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ trans('collejo::setup.name') }}</label>  
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" placeholder="{{ trans('collejo::setup.first_name') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" placeholder="{{ trans('collejo::setup.last_name') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </li>              
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ trans('collejo::setup.email') }}</label>  
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" placeholder="example@collejo.com">
                    </div>
                </div>
            </li>     
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ trans('collejo::setup.password') }}</label>  
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ trans('collejo::setup.password_confirm') }}</label>  
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="password" name="password2" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <button type="submit" class="btn btn-lg btn-success pull-right">{{ trans('collejo::common.continue') }}</button>
    </form>

    <script type="text/javascript">
        $('#db-credentials-form').validate({
            rules:{
                first_name:{
                    required:true
                },
                password:{
                    required:true
                },
                password2:{
                    required:true
                },
                email:{
                    required:true,
                    email:true
                }
            },
            submitHandler:function(form){
                $(form).ajaxSubmit({
                    beforeSubmit:Collejo.form.lock(form),
                    success:function(response){
                        if (response.success) {
                            $('#content').empty().append(response.data.html);
                        }
                    }
                });
            }
        })
    </script>
</div>