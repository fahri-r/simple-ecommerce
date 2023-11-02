<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Tailwind</title>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.ico')}}" type="image/x-icon">

    <!-- <link rel="stylesheet" href="/resources/css/main.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    @vite('../../node_modules/@fortawesome/fontawesome-free/css/all.min.css')
    @vite('resources/css/app.css')
    @vite('resources/css/main.css')
    @vite("resources/js/app.js")
</head>

<body>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @yield('script')
</body>

</html>
