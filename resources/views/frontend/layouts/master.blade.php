<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Halaman Depan</title>

    <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
</head>

<body class="bg-soft-blue">
    @include('frontend.layouts.navbar')

    <section class="container-fluid py-5 px-0 px-md-5">
        @yield('content')
    </section>

    @include('frontend.layouts.footer')

    <script src="{{ asset('frontend/assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('checkoutModal').addEventListener('shown.bs.modal', function() {
            document.getElementById('name').focus();
        });
    </script>
</body>

</html>
