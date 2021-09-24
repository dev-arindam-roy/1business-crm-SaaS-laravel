<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('crm.name') }} | Forgot Password</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/css/components-rounded.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/crm.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link rel="shortcut icon" href="{{ asset(config('theme.public_root') . '/favicon.ico') }}" />
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-6">
                    <form name="frmx_forgotPassword" id="frmx_forgotPassword" action="{{ route('auth.forgotPassword.Process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="font-green"><strong>Forgot password?</strong></h1>
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="note note-success">
                                    <p class="block font-green-seagreen"><strong>Don't worry!</strong> <br/> Please enter your registered email address to get the reset password link.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <span><i class="fa fa-warning"></i> Request you that please input valid information and proceed.</span>
                                </div>
                            </div>
                        </div>
                        
                        @if (Session::has('msgbox') && !empty(Session::get('msgbox')))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert {{ Session::get('msgbox')['type'] }}">
                                    <button class="close" data-close="alert"></button>
                                    <p>{!! Session::get('msgbox')['title'] !!}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (count($errors->forgotPasswordValidation))
                        <div class="row" id="serverValiAlert">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <ul>
                                        @foreach ($errors->forgotPasswordValidation->all() as $error)
                                            <li><i class="fa fa-warning"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if ($errors->forgotPasswordValidation->has('email_id')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-envelope"></i>
                                        </span>
                                        <input type="email" name="email_id" id="email_id" maxlength="60" class="form-control" placeholder="Registered Email" autocomplete="off" required="required" value="{{ old('email_id') }}"> 
                                    </div>
                                    @if ($errors->forgotPasswordValidation->has('email_id'))
                                        <div class="input-error-block">{{ $errors->forgotPasswordValidation->first('email_id') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <button type="submit" id="submitBtn" class="btn btn-success">Get Password Reset Link</button>
                            </div>
                            <div class="col-md-7 text-right">
                                <a href="{{ route('auth.createAccount') }}" class="btn green btn-outline">Create Account</a>
                                <a href="{{ route('auth.signIn') }}" class="btn green btn-outline">Sign In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/crm.js') }}"></script>
    </body>
    <script>
    jQuery(document).ready(function () {
        const actionForm = $('#frmx_forgotPassword');
        actionForm.validate({
            errorElement: 'div',
            errorClass: 'input-error-block',
            ignore: [],
            focusInvalid: false,
            normalizer: function (value) {
                return $.trim(value);
            },
            rules: {
                email_id: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email_id: {
                    required: 'Please enter your registered email address.',
                    email: 'Please enter a valid email address.'
                }
            },
            invalidHandler: function(event, validator) { 
                $('.alert-danger', actionForm).show();
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) { 
                $(element).closest('.form-group').removeClass('has-error');
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error').addClass('has-success');
                label.remove();
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-group'));
            },
            submitHandler: function(form) {
                $('#serverValiAlert').hide();
                $('#submitBtn').attr('disabled', 'disabled');
                $('.alert-danger', actionForm).hide();
                $.blockUI({ 
                    message: '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i> <br/> Processing...',
                    css: { 
                        border: 'none', 
                        padding: '40px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } 
                });
                setTimeout(function() { 
                    form.submit(); 
                }, 3000);
            }
        });

        actionForm.keypress(function(e) {
            if (e.which == 13) {
                if (actionForm.validate().form()) {
                    actionForm.submit();
                }
                return false;
            }
        });

        $('#resetForm').on('click', function () {
            actionForm[0].reset();
            actionForm.trigger("reset");
            actionForm.validate().resetForm();
            actionForm.find('.form-group').removeClass('has-error').removeClass('has-success');
            actionForm.find('.alert-danger').hide();
        });
    });
    </script>
</html>