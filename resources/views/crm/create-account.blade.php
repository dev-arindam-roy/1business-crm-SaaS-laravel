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
            <div class="row">
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-6">
                    <form name="frmx_createAccount" id="frmx_createAccount" action="{{ route('auth.createAccount.Process') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="font-green"><strong>Create Your Account</strong></h1>
                                <p class="mt--1 ml-5 font-grey-salsa" style="font-style: italic;">Manage your business with easy and smart way</p>
                                <hr/>
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
                        @if (count($errors->createAccountValidation))
                        <div class="row" id="serverValiAlert">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <ul>
                                        @foreach ($errors->createAccountValidation->all() as $error)
                                            <li><i class="fa fa-warning"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->createAccountValidation->has('first_name')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-user"></i>
                                        </span>
                                        <input type="text" name="first_name" class="form-control" maxlength="30" placeholder="First Name" autocomplete="off" required="required" value="{{ old('first_name') }}"> 
                                    </div>
                                    @if ($errors->createAccountValidation->has('first_name'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('first_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->createAccountValidation->has('last_name')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-user"></i>
                                        </span>
                                        <input type="text" name="last_name" class="form-control" maxlength="30" placeholder="Last Name" autocomplete="off" required="required" value="{{ old('last_name') }}"> 
                                    </div>
                                    @if ($errors->createAccountValidation->has('last_name'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('last_name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if ($errors->createAccountValidation->has('mobile_number')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-screen-smartphone"></i>
                                        </span>
                                        <input type="text" name="mobile_number" id="mobile_number" maxlength="12" class="form-control onlyNumber" placeholder="Mobile Number" autocomplete="off" required="required" value="{{ old('mobile_number') }}"> 
                                    </div>
                                    @if ($errors->createAccountValidation->has('mobile_number'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('mobile_number') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  @if ($errors->createAccountValidation->has('email_id')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-envelope"></i>
                                        </span>
                                        <input type="email" name="email_id" id="email_id" maxlength="60" class="form-control" placeholder="Email Address" autocomplete="off" required="required" value="{{ old('email_id') }}"> 
                                    </div>
                                    @if ($errors->createAccountValidation->has('email_id'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('email_id') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->createAccountValidation->has('password')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-lock"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control password" id="password" maxlength="20" placeholder="Password" autocomplete="off" required="required"> 
                                        <a href="javascript:void(0);" class="pwd-eye pwd-toggle"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                    @if ($errors->createAccountValidation->has('password'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if ($errors->createAccountValidation->has('confirm_password')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-lock"></i>
                                        </span>
                                        <input type="password" name="confirm_password" class="form-control password" maxlength="20" placeholder="Confirm Password" autocomplete="off" required="required">
                                        <a href="javascript:void(0);" class="pwd-eye pwd-toggle"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                    @if ($errors->createAccountValidation->has('confirm_password'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('confirm_password') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if ($errors->createAccountValidation->has('business_name')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-briefcase"></i>
                                        </span>
                                        <input type="text" name="business_name" class="form-control" maxlength="60" placeholder="Business Name" autocomplete="off" required="required" value="{{ old('business_name') }}"> 
                                    </div>
                                    @if ($errors->createAccountValidation->has('business_name'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('business_name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if ($errors->createAccountValidation->has('subdomain')) has-error @endif">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icon-link"></i>
                                        </span>
                                        <input type="text" name="subdomain" id="subdomain" class="form-control" maxlength="20" placeholder="Business URL" autocomplete="off" required="required" value="{{ old('subdomain') }}">
                                        <span class="input-group-addon">
                                            .1businesscrm.in
                                        </span> 
                                    </div>
                                    @if ($errors->createAccountValidation->has('subdomain'))
                                        <div class="input-error-block">{{ $errors->createAccountValidation->first('subdomain') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <button type="submit" id="submitBtn" class="btn btn-success">Create Account</button>
                                <a href="{{ route('auth.signIn') }}" class="btn green btn-outline">Sign In</a>
                            </div>
                            <div class="col-md-4 text-right">
                                <button type="button" class="btn red btn-outline" id="resetForm">Reset</button>
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
        $.validator.addMethod("onlyAlpha", function(value) {
            return /^[A-Z a-z]+$/.test(value);
        });
        $.validator.addMethod("checklower", function(value) {
            return /[a-z]/.test(value);
        });
        $.validator.addMethod("checkupper", function(value) {
            return /[A-Z]/.test(value);
        });
        $.validator.addMethod("checkdigit", function(value) {
            return /[0-9]/.test(value);
        });
        $.validator.addMethod("checksymbol", function(value) {
            return /[!@#$%&*]/.test(value);
        });
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[A-Z]/.test(value);
        });
        const actionForm = $('#frmx_createAccount');
        actionForm.validate({
            errorElement: 'div',
            errorClass: 'input-error-block',
            ignore: [],
            focusInvalid: false,
            normalizer: function (value) {
                return $.trim(value);
            },
            rules: {
                first_name: {
                    required: true,
                    minlength: 3,
                    onlyAlpha: true
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    onlyAlpha: true
                },
                email_id: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('emailExistOrNot') }}",
                        type: "post",
                        data: {
                            "email": function() {
                                return $("#email_id").val();
                            },
                            "_token": function() {
                                return "{{ csrf_token() }}";
                            }
                        }
                    }
                },
                mobile_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 12,
                    digits: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                    checklower: true,
                    checkupper: true,
                    checkdigit: true,
                    checksymbol: true
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                subdomain: {
                    required: true,
                    minlength: 3,
                    nowhitespace: true,
                    pattern: /^[A-Za-z\d-.]+$/,
                    remote: {
                        url: "{{ route('subdomainExistOrNot') }}",
                        type: "post",
                        data: {
                            "subdomain": function() {
                                return $("#subdomain").val();
                            },
                            "_token": function() {
                                return "{{ csrf_token() }}";
                            }
                        }
                    }
                },
                business_name: {
                    required: true
                }
            },

            messages: {
                first_name: {
                    required: 'Please enter your first name.',
                    onlyAlpha: 'Please enter valid first name.'
                },
                last_name: {
                    required: 'Please enter your last name.',
                    onlyAlpha: 'Please enter valid last name.'
                },
                email_id: {
                    required: 'Please enter your email-id.',
                    email: 'Please enter valid email address.',
                    remote: 'Email-id already exist, Please enter another.'
                },
                mobile_number: {
                    required: 'Please enter your mobile number.'
                },
                password: {
                    required: 'Please enter a password.',
                    checklower: 'Need atleast one lowercase alphabet.',
                    checkupper: 'Need atleast one uppercase alphabet.',
                    checkdigit: 'Need atleast one digit.',
                    checksymbol: 'Need atleast one symbol.'
                },
                confirm_password: {
                    required: 'Please enter the password again.',
                    equalTo: 'Confirm password not match with password.'
                },
                subdomain: {
                    required: 'Please enter a business url.',
                    nowhitespace: 'Space not allowed.',
                    pattern: 'Sub domain format invalid.',
                    remote: 'This business url already exist, Please try another.'
                },
                business_name: {
                    required: 'Please enter your business name.'
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