@extends('collejo::layouts.dash')

@section('title', 'New Student')

@section('content')

<section class="section">

<script type="text/javascript">
$(function(){
    $('#edit-details-form').validate({
        /*rules:{
            first_name:{
                required:true
            },
            last_name:{
                required:true
            }
        },*/
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType:  'json',
                //beforeSubmit:Collejo.form.lock(form),
                success: function(response){
                    if(!response.success){
                        Collejo.form.unlock(form)
                    }                   
                }
            });
        }
    });
});    
</script>

<h2>New Student</h2>

<div class="row">
  
    <div class="col-xs-2">
        
        @include('students::partials.tabs')

    </div>

    <div class="col-xs-10">
        <div class="tab-content">
            <div class="tab-pane active">

                <form class="form-horizontal" method="POST" id="edit-details-form" action="{{ route('students.new') }}">

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="first_name" class="form-control" placeholder="Jon">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="last_name" class="form-control" placeholder="Doe">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="date_of_birth" class="form-control date-input">
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>  

                    <div class="clearfix"></div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary btn-lg" data-loading-text="Saving...">Save</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>

                </form>

            </div>
        </div>
    </div>

</div>

</section>

@endsection