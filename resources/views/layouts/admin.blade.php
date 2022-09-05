<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="icon">
    <title>Allure Industries - CRM - {{ $title }}</title>
    @stack('style')
    <x-style></x-style>

    <!-- End Google Tag Manager -->
</head>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="https://allureindustries.com/files/uploads/2016/03/600.png" alt="" />
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
    <x-sidebar>{{ $title }}</x-sidebar>

    <!-- content -->
    @yield('content')

    <!-- footer -->
    {{-- <x-footer></x-footer> --}}
    <!-- welcome modal end -->
    <!-- js -->
    <x-script></x-script>
    @stack('script')
</body>

</html>
