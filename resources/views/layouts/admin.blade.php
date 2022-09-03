<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>
    <x-style></x-style>
    @stack('style')

    <!-- End Google Tag Manager -->
</head>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="vendors/images/deskapp-logo.svg" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>
    <!-- navbar -->
    <x-navbar></x-navbar>

    <!-- sidebar -->
    <x-sidebar></x-sidebar>

    <!-- content -->
    @yield('content')

    <!-- footer -->
    {{-- <x-footer></x-footer> --}}
    <!-- welcome modal end -->
    <!-- js -->
    <x-script></x-script>
    @stack('script')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
