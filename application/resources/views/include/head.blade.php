<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{isset($site->image3) ? asset(path_site_favicon_image().$site->image3) : Avatar::create(auth()->user()->name)->toBase64()}}" type="image/x-icon">

<!-- font awesome library -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<!-- themekit admin template asstes -->
<link rel="stylesheet" href="{{ asset('all.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">



<!-- Stack array for including inline css or head elements -->
@stack('head')
<link rel="stylesheet" href="{{asset('css/minimal.css')}}">
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
