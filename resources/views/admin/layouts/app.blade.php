@extends('admin.layouts.base')

@section('child')
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
        @include('admin.layouts.partials.sidebar')
        <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            @include('admin.layouts.partials.topbar')
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-lg">
                    @yield('content')
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2020 - <?php echo date('Y')?> Web Media Solusi Digital Powered by DashLite. Template by <a href="https://softnio.com" target="_blank">Softnio</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
@endsection
<!-- JavaScript -->
@section('script')
<script src="{{ asset('admin/assets/assets/js/bundle.js?ver=2.2.0') }}"></script>
<script src="{{ asset('admin/assets/assets/js/scripts.js?ver=2.2.0') }}"></script>
<script src="{{ asset('admin/assets/assets/js/charts/gd-default.js?ver=2.2.0') }}"></script>
<script src="{{ asset('admin/assets/assets/js/charts/gd-analytics.js?ver=2.2.0') }}"></script>
<script src="{{ asset('admin/assets/assets/js/libs/jqvmap.js?ver=2.2.0') }}"></script>
@if(isset($mod))
<!--Script Custom-->
<script src="{{ asset('admin/mod/' . $mod . '.js') }}"></script>
@endif
<script src="{{ asset('admin/mod/mod_main.js') }}"></script>
@endsection