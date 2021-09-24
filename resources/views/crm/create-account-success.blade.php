<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('crm.name') }} | Create Account</title>
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
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="note note-success">
                        <h1 class="font-green-seagreen">Hi, <strong>{{ $user->first_name }} <br/> Your account has been created successfully.</strong></h1>
                        <hr/>
                        <h3 class="font-green">Hope you received our account verification mail in your inbox. <br/> Please check your mail and click the verification link and <strong>Activate Your Account</strong>, Thanks.</h3>
                        <hr/>
                        <h4 class="font-green-seagreen"><i class="icon-briefcase"></i> Business Account Name : <strong>{{ $user->businessInfo->business_name }}</strong></h4>
                        <h4 class="font-green-seagreen"><i class="icon-envelope"></i> Business Email Address : <strong>{{ $user->email_id }}</strong></h4>
                        <h4 class="font-green-seagreen"><i class="icon-globe"></i> Business Account URL : <strong>{{ route('auth.businessLogin', array('subdomain' => $user->subdomainInfo->name)) }}</strong></h4>
                        <hr/>
                        <div id="resendActionBox">
                            <h4 class="font-green-seagreen">If you not received any verification mail from us then please click on the <span class="font-green-seagreen"><strong>"Resend Verification Mail"</strong></span> button, thankyou.</h4>
                            <form name="frmx_resendMail" id="frmx_resendMail" action="{{ route('auth.resendVerification.Mail', array('success_token' => $token)) }}" method="post">
                                @csrf
                                <button type="submit" id="submitBtn" class="btn green-sharp">Resend Account Verification Mail</button>
                                <button type="button" id="changeEmailBtn" class="btn green-sharp">Change Email Address</button>
                            </form>
                        </div>
                        <div id="changeActionBox" style="display: none;">
                            <form name="frmx_changeMail" id="frmx_changeMail" action="{{ route('auth.change.Email', array('success_token' => $token)) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="icon-envelope"></i>
                                                </span>
                                                <input type="email" name="email_id" id="email_id" maxlength="60" class="form-control" placeholder="Email Address" autocomplete="off" required="required" value="{{ $user->email_id }}"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" id="changeBtn" class="btn green-sharp">Change</button>
                                        <button type="button" id="backBtn" class="btn red btn-outline">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if (Session::has('msgbox'))
                            <p class="font-green-seagreen" style="margin-top: 5px;">{!! Session::get('msgbox')['title'] !!}</p>
                        @endif
                        @if (count($errors->changeEmailValidation))
                        <div class="row" id="serverValiAlert" style="margin-top: 10px;">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->changeEmailValidation->all() as $error)
                                            <li><i class="fa fa-warning"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mt-2 text-center">
                    <a href="{{ route('root.index') }}" class="btn green btn-outline">Home</a>
                    <a href="{{ route('auth.createAccount') }}" class="btn green btn-outline">Create Account</a>
                    <a href="{{ route('auth.signIn') }}" class="btn green btn-outline">Sign In</a>
                </div>
            </div>
        </div>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    </body>
    <script>
    jQuery(document).ready(function () {
        $('#submitBtn').on('click', function () {
            $('#submitBtn').attr('disabled', 'disabled');
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
                $('#frmx_resendMail').submit(); 
            }, 3000);
        });

        $('#changeEmailBtn').on('click', function () {
            $('#serverValiAlert').hide();
            $('#resendActionBox').hide('fast', function () {
                $('#changeActionBox').show();
            });
        });

        $('#backBtn').on('click', function () {
            $('#changeActionBox').hide('fast', function () {
                $('#resendActionBox').show();
            });
        });

        const actionForm = $('#frmx_changeMail');
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
                    required: 'Please enter new email address.'
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
                $('#changeBtn').attr('disabled', 'disabled');
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
    });
    </script>
</html>