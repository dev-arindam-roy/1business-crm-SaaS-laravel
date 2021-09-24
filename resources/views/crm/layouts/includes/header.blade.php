<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <title>{{ config('crm.name') }} @stack('page_title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/pace/themes/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/css/components-rounded.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/layouts/layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/assets/layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset(config('theme.theme_assets_path') . '/crm.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link rel="shortcut icon" href="{{ asset(config('theme.public_root') . '/favicon.ico') }}" />
        @stack('page_css')
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">