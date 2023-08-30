<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MovieList | {{ $title }}</title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet" />
    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <!-- BOX AND BS ICONS -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- APP CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('css/grid.css') }}>
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <!-- APP Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- OWL CAROUSEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>

</head>

<body>
    @include('layout.navbar')
    @yield('container')

    <!-- FOOTER SECTION -->
    <footer class="section pb-4">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-6 col-sm-12">
                    <div class="content">
                        <a href="#" class="logo">
                            <i class="main-color"></i><span class="main-color">Movie</span><span>List</span>
                        </a>
                        <p>
                            <span>Movie</span><span class="main-color">List</span> is a website that contains list of movie
                        </p>
                        <div class="social-list mt-0">
                            <a href="#" class="social-item">
                                <i class="bx bxl-twitter"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bx bxl-instagram"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bi bi-reddit"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </div>
                        <div class="sitemap-list">
                            <a href="#" class="sitemap-item">
                                <span>Privacy Policy</span>
                            </a>
                            <a href="#" class="sitemap-item">
                                <span>Term of Service</span>
                            </a>
                            <a href="#" class="sitemap-item">
                                <span>Contact Us</span>
                            </a>
                            <a href="#" class="sitemap-item">
                                <span>About Us</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER SECTION -->

    <!-- COPYRIGHT SECTION -->
    <div class="copyright">Copyright <i class="bi bi-c-circle"></i> {{ date("Y") }} <span class="main-color">Movie</span><span>List</span> All Rights Reserved</div>
    <!-- END COPYRIGHT SECTION -->
    <!-- APP SCRIPT -->
    <script src={{ asset('js/home.js') }}></script>
</body>
</html>
