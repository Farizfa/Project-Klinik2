<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Vendor CSS Files -->
        <link href="{{ asset('/Medilab/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/Medilab/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('/Medilab/assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('/Medilab/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/Medilab/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/Medilab/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


        <!-- Main CSS File -->
        <link href="{{ asset('/Medilab/assets/css/main.css') }}" rel="stylesheet">

    </head>

    <body class="index-page">
        @include('sweetalert::alert')

        @include('component.pasien.navbar')
        {{-- pages --}}
        <main class="main">
            @yield('content')
        </main>
        @include('component.pasien.footer')

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{ asset('/Medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/Medilab/assets/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('/Medilab/assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('/Medilab/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('/Medilab/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('/Medilab/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


        <!-- Main JS File -->
        <script src="{{ asset('/Medilab/assets/js/main.js') }}"></script>

    </body>

</html>