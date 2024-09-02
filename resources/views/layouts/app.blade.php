<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Plugins: CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    </head>

    <body>
        <div class="container-scroller">

            <!-- Navbar -->
            @include('partials.navbar')

            <div class="container-fluid page-body-wrapper">

                <!-- Sidebar -->
                @include('partials.sidebar')

                <!-- Main Content -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>

                    <!-- Footer -->
                    @include('partials.footer')
                </div>
            </div>
        </div>

        <!-- Plugins: JS -->
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Include Select2 CSS and JS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

        <!-- Inject: JS -->
        <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('assets/js/misc.js') }}"></script>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
        <script src="{{ asset('assets/js/todolist.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    </body>

</html>
