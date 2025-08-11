<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../../assets/img/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="../../assets/img/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="../../assets/img/favicon/favicon-16x16.png" sizes="16x16" type="image/png">

    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="../../assets/img/favicon/favicon.ico">
    <meta name="msapplication-config" content="../../assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">

    <!-- Apex Charts -->
    <link type="text/css" href="/vendor/apexcharts/apexcharts.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker-bs4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fontawesome -->
    <link type="text/css" href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link type="text/css" href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="/css/volt.css" rel="stylesheet">

    @livewireStyles

    @livewireScripts

    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <!-- Vendor JS -->
    <script src="/assets/js/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="/assets/js/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="/assets/js/smooth-scroll.polyfills.min.js"></script>

    <!-- Apex Charts -->
    <script src="/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Charts -->
    <script src="/assets/js/chartist.min.js"></script>
    <script src="/assets/js/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="/assets/js/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Notyf -->
    <script src="/vendor/notyf/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="/assets/js/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="/assets/js/volt.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2 { width: 100% !important; }
        .select2-selection {
            height: 35px !important;
            width: 100% !important;
            font-size: 0.875rem !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            color: #6B7280 !important;
            background-color: #ffffff !important;;
            background-clip: padding-box !important;;
            border: 0.0625rem solid #D1D5DB !important;;
            appearance: none !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07) !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
        }
        .select2-search__field {
            font-size: 0.875rem !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            color: #6B7280 !important;
            background-color: #ffffff !important;;
            background-clip: padding-box !important;;
            border: 0.0625rem solid #D1D5DB !important;;
            appearance: none !important;
            padding-left: 10px !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07) !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
        }
            
        .select2-selection__rendered { line-height: 33px !important; padding-left: 12px !important; }
        .select2-selection__arrow { 
            height: 30px !important;
            position: absolute !important;
            top: 1px !important;
            right: 10px !important;
            width: 20px !important;
        }
        .select2-container--default .select2-results__option {
            padding: 0px !important;
            margin-right: 4px !important;
            margin-left: 4px !important;
            margin-bottom: 4px !important;
            padding-top: 4px !important;
            padding-bottom: 3px !important;
            padding-left: 10px !important;
            border-radius: 5px !important;
        }
        .select2-results__options { margin-top: 10px !important; margin-bottom: 10px !important; }
        .select2-container--default .select2-results__option:hover {
            background-color: #1F2937;
            color: white !important;
            transition: background-color 0.1s ease;
        }
        .select2-results__option--highlighted {
            background-color: #1F2937 !important;
            color: white !important;
        }
        .select2-dropdown {
            margin-top: 5px !important; 
            border: 0.0625rem solid #D1D5DB !important;;
            border-radius: 0.5rem !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07) !important;
        }
    </style>
</head>

<body>
    @include('theme.nav') {{-- Nav --}}
    @include('theme.sidenav',[$setting]) {{-- SideNav --}}

    <main class="content">
        @include('theme.topbar', [$membersWithPendingFees, $expiredMembers]) {{-- TopBar --}}
        {{ $slot }}
        @include('theme.footer')
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(".modern-select").select2({});
</script>
</html>
