<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="Nutrition Responsive  HTML5 Template " />
<meta name="keywords" content="business,corporate, creative, woocommerach, design, gallery, minimal, modern, landing page, cv, designer, freelancer, html, one page, personal, portfolio, programmer, responsive, vcard, one page" />
<meta name="author" content="Nutrition" />
<!-- Place favicon.ico in the root directory -->
<link rel="shortcut icon" href="{{isset($site->image3) ? asset(path_site_favicon_image().$site->image3) : Avatar::create(auth()->user()->name)->toBase64()}}" type="image/x-icon">

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- fonts file -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- css file  -->
<link rel="stylesheet" href="{{ asset('front/assets/css/plugins.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/custom.css') }}">
<script src="{{ asset('front/assets/js/modernizr-3.11.2.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

@stack('styles')
