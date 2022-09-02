<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <x-style></x-style>

    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- navbar -->
    <x-navbar></x-navbar>

    <!-- sidebar -->
    <x-sidebar></x-sidebar>

    <!-- content -->
    @yield('content')

    <!-- footer -->
    <x-footer></x-footer>
    <!-- welcome modal end -->
    <!-- js -->
    <x-script></x-script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
