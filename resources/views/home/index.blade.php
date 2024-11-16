<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        @include('home.header')
        <!-- Header End -->


        <!-- Carousel Start -->
        @include('home.carousel')
        <!-- Carousel End -->


        <!-- About Start -->
        @include('home.about')
        <!-- About End -->


        <!-- Room Start -->
        @include('home.room')
        <!-- Room End -->


        <!-- Video Start -->
        @include('home.video')
        <!-- Video Start -->


        <!-- Gallery Start -->
        @include('home.gallery')
        <!-- Gallery End -->


        <!-- Service Start -->
        @include('home.service')
    </div>
    <!-- Service End -->


    <!-- Contacts Start -->
    @include('home.contacts')
    <!-- Contacts End -->


    <!-- Footer Start -->
    @include('home.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    @include('home.script')

    <script>
        $(window).scroll(function() {
          sessionStorage.scrollTop = $(this).scrollTop();
        });

        $(document).ready(function() {
           if (sessionStorage.scrollTop != "undefined") {
        $(window).scrollTop(sessionStorage.scrollTop);
         }
       });
    </script>

</body>

</html>