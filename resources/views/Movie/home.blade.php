<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        CineMaster
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>

<body>
    <div class="nav-wrapper">
        <div class="container">
            <div class="nav">
                <a href="#" class="logo">
                    <span class="main-color">P</span>irate<span class="main-color">B</span>ai
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="#">Home</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle">Genre</a>
                        <div class="dropdown-menu">
                          <select id="genreFilter" class="genre-dropdown">
                            <option>Select Genre</option>
                            <option>Action</option>
                            <option>Comedy</option>
                            <option>Drama</option>
                            <option>Thriller</option>
                            <option>Horror</option>
                            <option>Romance</option>
                          </select>
                        </div>
                      </li>
                    <li class="search-box-container">
                        <form action="#" method="get">
                            <input type="text" id="search-input" class="search-input" placeholder="Search by title...">
                            <button type="submit" class="search-button">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    

    <!-- Preview SECTION -->
    <div class="hero-section">
        <!-- Preview SLIDE -->
        <div class="hero-slide">
            <div class="owl-carousel carousel-nav-center" id="hero-carousel">
                <!-- Preview ITEM -->
                <div class="hero-slide-item">
                    <img src="./images/Wicked-banner.jpg" alt="">
                    <div class="overlay"></div>
                    <div class="hero-slide-item-content">
                        <div class="item-content-wraper">
                            <div class="item-content-title top-down">
                                Wicked
                            </div>
                            <div class="movie-infos top-down delay-2">
                                <div class="movie-infos">
                                    <div class="movie-info" id="description">
                                        <span>Elphaba, the future Wicked Witch of the West, and her friendship with her classmate Galinda, who becomes Glinda the Good. </span>
                                    </div>
                                    
                                </div>
                                <div class="movie-info" id="rating">
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>

                                    <span>5 Ratings</span>
                                </div>
                            </div>

                            <div class="item-action top-down delay-6">
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Preview ITEM -->   
            </div>
        </div>
        <!-- END Preview Item-->
    </div>
    <!-- END Preview SECTION -->

    
    <!-- TOP MOVIES -->
    <div class="top-movies-slide">
        <div class="section-header">
            Top Rated Movies
        </div>
        <div class="owl-carousel" id="top-movies-slide">
            <!-- MOVIE ITEM -->
            <div class="movie-item">
                <img src="./images/Wicked.jpg" alt="">
                <div class="movie-item-content">
                    <div class="movie-item-title">
                        Wicked
                    </div>
                    <div class="movie-infos">
                        
                        <div class="movie-info" id="duration">
                            <i class="bx bxs-time"></i>
                            <span>120 mins</span>
                        </div>
                        <div class="movie-info" id="rating">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <span>5 Ratings</span>
                        </div>
                        <div class="movie-info" id="genre"> 
                            <span class="movie-genre">Drama</span>
                        </div>
                        <div class="movie-info" id="release-date"> 
                            <span>Release Date: November 22, 2024</span>
                        </div>
                        <div class="movie-info" id="description">
                            <span>Description: Elphaba and her friendship with her classmate Galinda, who becomes Glinda the Good. </span>
                        </div>
                        <div class="movie-info" id="casts">
                            <span>Cast: Cynthia Erivo · Ariana Grande · Jeff Goldblum </span>
                        </div>
                    </div>
                    <button class="view-btn">View</button>
                </div>
            </div>
            <!-- END MOVIE ITEM -->
        </div>
    </div>

<!-- MOVIES SECTION -->
<div class="section">
    <div class="container">
        <div class="section-header">
            Movies
        </div>
        <div class="movies-slide carousel-nav-center owl-carousel">
             <!-- MOVIE ITEM -->
             
            <!-- END MOVIE ITEM -->
        </div>
    </div>
</div>
<!-- END MOVIES SECTION -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>