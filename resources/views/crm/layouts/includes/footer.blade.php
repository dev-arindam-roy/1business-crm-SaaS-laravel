@include('crm.layouts.includes.footer-bar')
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/sidebar-toggle.js') }}" type="text/javascript"></script>
<script src="{{ asset(config('theme.theme_assets_path') . '/crm.js') }}" type="text/javascript"></script>
@stack('page_js')
</body>
</html>