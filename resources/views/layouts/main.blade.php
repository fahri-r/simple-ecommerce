<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Tailwind</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- <link rel="stylesheet" href="/resources/css/main.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    @vite('../../node_modules/@fortawesome/fontawesome-free/css/all.min.css')
    @vite('resources/css/app.css')
    @vite('resources/css/main.css')
    @vite('resources/js/app.js')
</head>

<body>
    <!-- header -->
    @include('components.header')

    <!-- navbar -->
    @include('components.navbar')

    @yield('content')

    <!-- footer -->
    @include('components.footer')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        function getCookie(name) {
            var nameEQ = name + "=";
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1, cookie.length);
                }
                if (cookie.indexOf(nameEQ) == 0) {
                    return cookie.substring(nameEQ.length, cookie.length);
                }
            }
            return null;
        }
    </script>
    <script>
        $(document).ready(function() {
            document.getElementById(`account`).innerHTML = getCookie('username') ?? 'Account';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
</body>

</html>
