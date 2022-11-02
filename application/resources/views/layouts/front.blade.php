<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>@yield('title','') | Childhood Nutrition</title>
	<!-- initiate head with meta tags, css and script -->
	@include('front.include.head')

</head>

<body>
    <!-- preloader start -->
    <div class="preloader">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- preloader end -->

    @include('front.include.sidebar')

    <div class="body-overlay"></div>

    <!-- main sidebar area end here  -->
    <main class="main-content section-bottom">
        @include('front.include.header')
        <div class="main-section-wrap">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </main>



	<!-- initiate scripts-->
	@include('front.include.footer')


</body>

</html>
