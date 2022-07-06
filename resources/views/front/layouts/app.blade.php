<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- styles -->
    @stack('prepend-style')
    @include('front.includes.styles')
    @stack('addon-style')
</head>

<body>
    <!-- Navigation-->
    @include('front.includes.navigation')

    <!-- Section-->
    @yield('content')

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>

    <!-- script -->
    @stack('prepend-script')
    @include('front.includes.scripts')
    @stack('addon-script')
</body>

</html>