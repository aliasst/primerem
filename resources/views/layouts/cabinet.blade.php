<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--<link rel="shortcut icon" href="favicon.ico?v=1.2" type="image/x-icon" />-->
    <link rel="stylesheet" href="/css/reset.css"/>
    <link rel="stylesheet" href="/css/fonts.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <link rel="stylesheet" href="/css/style.css@php echo '?'.mt_rand()@endphp" />
    <meta property="og:type" content="website"/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content="/img/logo.png"/>

    <title> @yield('title')</title>
    <meta name="description"
          content="Вы получите самый изысканный ремонт, с равными ежемесячными платежами. Без посещения объекта. Весь процесс онлайн, без нервов.">
</head>
<body class="cabinet-body">


@yield('content')




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
<script src="/js/scripts.js?v=1.99"></script>

</body>
</html>
