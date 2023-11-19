<!doctype html>
<html lang="en">
  <head>
  <title></title>
  </head>
  <body>
<!-- Amb header start -->
    @include('front/ar/email_templates/includes/header')
<!-- Amb header end -->

<!-- Amb banner bottom section start -->

    @yield('content')

<!-- footer open -->
@include('front/ar/email_templates/includes/copyright')
<body>
</html>