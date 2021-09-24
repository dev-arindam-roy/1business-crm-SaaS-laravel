@include('crm.layouts.includes.header')
@include('crm.layouts.includes.header-nav')
<div class="page-container">
    @include('crm.layouts.includes.left-sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            @yield('page_contents')
        </div>
    </div>
</div>
@include('crm.layouts.includes.footer')