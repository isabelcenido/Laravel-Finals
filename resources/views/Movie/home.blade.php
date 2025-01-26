<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        PirateBai
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
</head>

<body>
    <div class="nav-wrapper">
        <div class="container">
            <div class="nav">
                <a href="#nav-menu" class="logo">
                    <span class="main-color">P</span>irate<span class="main-color">B</span>ai
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <li class="search-box-container">
                        <form action="#" method="get" autocomplete="off">
                            <input 
                                type="text" 
                                id="search-input" 
                                class="search-input" 
                                placeholder="Search by title... " 
                            />
                            <!-- Suggestions Dropdown -->
                            <ul id="search-suggestions" class="suggestions-dropdown"></ul>
                        </form>
                    </li>
                    <li><a href="{{route('login')}}">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    

    <!-- Hero Section -->
    <div class="hero-section">
        <!-- Hero Slide -->
        <div class="hero-slide">
            <div class="owl-carousel carousel-nav-center" id="hero-carousel">
                @forelse ($topRatedMovies as $movie)
                    <!-- Hero Slide Item -->
                    <div class="hero-slide-item">
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}">
                        <div class="overlay"></div>
                        <div class="hero-slide-item-content">
                            <div class="item-content-wraper">
                                <div class="item-content-title top-down">
                                    {{ $movie->title }}
                                </div>
                                <div class="movie-infos top-down delay-2">
                                    <div class="movie-info" id="description">
                                        <span>{{ $movie->description }}</span>
                                    </div>
                                    <div class="movie-info" id="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bx bxs-star"></i>
                                        @endfor
                                        <span>{{ $movie->ratings }} Ratings</span>
                                    </div>
                                </div>
                                <div class="item-action top-down delay-6">
                                    <!-- Optional actions, e.g., Watch Trailer, View Details -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Hero Slide Item -->
                @empty
                    <div style="margin-block: 10rem; margin-inline: 2rem;">
                        <div class="item-content-title top-down">
                            No top-rated movies found.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- End Hero Slide -->
    </div>

    <!-- END Preview SECTION -->

    
    <!-- MOVIES -->
    <div class="top-movies-slide">
        <div class="section-header">
            <div class="">
                Movies
            </div>
            <div class="genre-filter">
                <label for="genre-select">Filter by Genre:</label>
                <select id="genre-select" onchange="filterByGenre()">
                    <option value="">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="owl-carousel" id="top-movies-slide">
            @forelse ($allMovies as $movie)
                <!-- MOVIE ITEM -->
                <div class="movie-item">
                    <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}">
                    <div class="movie-item-content">
                        <div class="movie-item-title">
                            {{ $movie->title }}
                        </div>
                        <div class="movie-infos">
                            <div class="movie-info" id="duration">
                                <i class="bx bxs-time"></i>
                                <span>{{ $movie->duration }}</span>
                            </div>
                            <div class="movie-info" id="rating">
                                @for ($i = 1; $i <= $movie->ratings; $i++)
                                    <i class="bx bxs-star"></i>
                                @endfor
                                <span>{{ $movie->ratings }}/5 Ratings</span>
                            </div>
                            <div class="movie-info" id="genre">
                                <span class="movie-genre">{{ $movie->genre->name }}</span>
                            </div>
                            <div class="movie-info" id="release-date">
                                <span>Release Date: {{ \Carbon\Carbon::parse($movie->release_date)->format('F d, Y') }}</span>
                            </div>
                        </div>
                        <button class="view-btn" data-id="{{ $movie->id }}">View</button>
                    </div>
                </div>
                <!-- END MOVIE ITEM -->
            @empty
                <div class="no-movies-found d-flex align-items-center">
                    <p>No movies found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content view-modal-content">
            <div class="view-modal-header position-relative">
                <button 
                    type="button" 
                    class="btn-close position-absolute top-0 end-0 p-3 text-white" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                    style="z-index: 10;">
                </button>
                <img 
                    id="movie-poster" 
                    src="" 
                    alt="Movie Poster" 
                    class="w-100 rounded-top movie-poster">
                <div class="overlay">
                    <h1 id="view-movie-title" class="movie-title text-white"></h1>
                </div>
            </div>
            <div class="view-modal-body d-flex flex-column flex-lg-row">
                <div class="details-section px-4 py-3 text-white bg-dark flex-grow-2">
                    <p><strong>Title:</strong> <span id="view-title"></span></p>
                    <p><strong>Genre:</strong> <span id="view-genre"></span></p>
                    <p><strong>Release Date:</strong> <span id="view-release-date"></span></p>
                    <p><strong>Duration:</strong> <span id="view-duration"></span></p>
                </div>
                <div class="description-section px-4 py-3 text-white bg-secondary flex-grow-1">
                    <p><strong>Description:</strong></p>
                    <p id="view-description" class="movie-description"></p>
                    <p><strong>Cast:</strong> <span id="view-cast"></span></p>
                    <p><strong>Ratings:</strong> <span id="view-ratings" class="ratings"></span>/5</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

    <script>
        function filterByGenre() {
            const selectedGenre = document.getElementById('genre-select').value;
            const url = new URL(window.location.href);
            if (selectedGenre) {
                url.searchParams.set('genre', selectedGenre);
            } else {
                url.searchParams.delete('genre');
            }
            window.location.href = url.toString();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const viewButtons = document.querySelectorAll('.view-btn');
            const searchInput = document.getElementById('search-input');
            const suggestionsDropdown = document.getElementById('search-suggestions');

            viewButtons.forEach(button => {
                button.addEventListener('click', async (event) => {
                    const movieId = event.target.getAttribute('data-id');

                    showMovieDetails(movieId);
                });
            });

            searchInput.addEventListener('input', async (event) => {
                const query = event.target.value.trim();
                suggestionsDropdown.innerHTML = '';

                if (query.length < 2) {
                    suggestionsDropdown.style.display = 'none';
                    return;
                }

                try {
                    const response = await fetch(`/search?query=${encodeURIComponent(query)}`);
                    if (!response.ok) throw new Error('Failed to fetch suggestions.');

                    const suggestions = await response.json();

                    if (suggestions.length === 0) {
                        suggestionsDropdown.style.display = 'none';
                        return;
                    }

                    suggestionsDropdown.innerHTML = suggestions
                        .map(
                            (movie) =>
                                `<li data-id="${movie.id}" class="suggestion-item">${movie.title}</li>`
                        )
                        .join('');
                    suggestionsDropdown.style.display = 'block';

                    // Add click event to each suggestion item
                    document.querySelectorAll('.suggestion-item').forEach((item) => {
                        item.addEventListener('click', (e) => {
                            const movieId = e.target.getAttribute('data-id');
                            showMovieDetails(movieId);
                        });
                    });
                } catch (error) {
                    console.error(error);
                }
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!searchInput.contains(event.target)) {
                    suggestionsDropdown.style.display = 'none';
                }
            });

            async function showMovieDetails(movieId) {
                try {
                    // Fetch movie details from the server using its ID
                    const response = await fetch(`/movies/${movieId}`);
                    if (!response.ok) throw new Error('Failed to fetch movie details.');

                    const movie = await response.json();

                    // Populate modal fields with movie data
                    document.getElementById('movie-poster').src = movie.poster || 'default-poster.jpg';
                    document.getElementById('view-movie-title').textContent = movie.title;
                    document.getElementById('view-title').textContent = movie.title;
                    document.getElementById('view-genre').textContent = movie.genre.name;
                    document.getElementById('view-release-date').textContent = movie.release_date;
                    document.getElementById('view-duration').textContent = movie.duration;
                    document.getElementById('view-description').textContent = movie.description;
                    document.getElementById('view-cast').textContent = movie.cast || 'N/A';
                    document.getElementById('view-ratings').textContent = movie.ratings || 'N/A';

                    // Show the modal
                    const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                    viewModal.show();
                } catch (error) {
                    console.error(error);
                    alert('Failed to load movie details. Please try again.');
                }
            }

        });
    </script>

</body>

</html>