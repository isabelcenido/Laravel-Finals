<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Admin
    </title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
     
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
</head>
<body>
    <div class="nav-wrapper">
        <div class="container">
            <div class="nav">
                <a href="#" class="logo">
                    <span class="main-color">P</span>irate<span class="main-color">B</span>ai
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="#">Home</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="movie-list">
            <div class="header">
                <h2>Movie List</h2>
                <div class="">
                    <button class="add-movie-btn" data-bs-toggle="modal" data-bs-target="#genreModal">Add Genre</button>
                    <button class="add-movie-btn" data-bs-toggle="modal" data-bs-target="#addModal">Add Movie</button>
                </div>
            </div>
            <table class="movie-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Released Date</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movies as $movie)
                        <tr>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->genre->name }}</td>
                            <td>{{ $movie->release_date }}</td>
                            <td>{{ $movie->duration }}</td>
                            <td class="actions">
                                <button class="action-btn view-btn" data-id="{{ $movie->id }}">View</button>
                                <button class="action-btn edit-btn" data-id="{{ $movie->id }}">Edit</button>
                                <button class="action-btn delete-btn" data-id="{{ $movie->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No movies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel"><span class="main-color">A</span>dd <span class="main-color">M</span>ovie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <br><input type="text" id="title" placeholder="Enter movie title" required>
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <br><select id="genre" required>
                                <option hidden selected>Select Genre</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <label for="release-date">Release Date</label>
                            <br><input type="date" id="release-date" required>
                        </div><br>
                        <div class="form-group">
                            <label for="ratings">Ratings</label>
                            <br><select id="ratings" required>
                                <option selected hidden>Select Ratings</option>
                                <option>5</option>
                                <option>4</option>
                                <option>3</option>
                                <option>2</option>
                                <option>1</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <br><input type="text" id="duration" placeholder="Enter duration (e.g., 2h 30m)" required>
                        </div><br>
                        <div class="form-group">
                            <label for="cast">Movie Cast</label>
                            <br><input type="text" id="cast" placeholder="Movie Casts" required>
                        </div><br>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <br><input type="description" id="description" placeholder="Enter movie description" required>   
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <br><input type="file" id="image" accept="image/*" required>
                        </div>
                        <br>
                        <div class="form-actions mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="modal-add-btn" class="btn btn-primary">Add Movie</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrollable Inclusions Section -->
    <div class="modal fade" id="genreModal" tabindex="-1" aria-labelledby="genreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="genreModalLabel">Manage Genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <label for="name" class="form-label">Add New Genre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mt-2" id="addInclusionButton">Add Genre</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Genres</label>
                        <div class="genre-container" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                            <!-- Genre will be dynamically loaded here -->
                            <ul id="genreList" class="list-group">
                                <!-- Placeholder for Genre -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
                    <p><strong>Cast:</strong> <span id="view-cast"></span></p>
                </div>
                <div class="description-section px-4 py-3 text-white bg-secondary flex-grow-1">
                    <p><strong>Description:</strong></p>
                    <p id="view-description" class="movie-description"></p>
                    <p><strong>Ratings:</strong> <span id="view-ratings" class="ratings"></span>/5</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><span class="main-color">E</span>dit <span class="main-color">M</span>ovie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="edit-title">Title</label>
                        <br><input type="text" id="edit-title" placeholder="Enter movie title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-genre">Genre</label>
                        <br><select id="edit-genre" required>
                            <option hidden selected>Select Genre</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="edit-release-date">Release Date</label>
                        <br><input type="date" id="edit-release-date" required>
                    </div><br>
                    <div class="form-group">
                        <label for="edit-ratings">Ratings</label>
                        <br><select id="edit-ratings" required>
                            <option selected hidden>Select Ratings</option>
                            <option>5</option>
                            <option>4</option>
                            <option>3</option>
                            <option>2</option>
                            <option>1</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="edit-duration">Duration</label>
                        <br><input type="text" id="edit-duration" placeholder="Enter duration (e.g., 2h 30m)" required>
                    </div><br>
                    <div class="form-group">
                        <label for="edit-cast">Movie Cast</label>
                        <br><input type="text" id="edit-cast" placeholder="Movie Casts" required>
                    </div><br>
                    <div class="form-group">
                        <label for="edit-description">Description</label>
                        <br><input type="description" id="edit-description" placeholder="Enter movie description" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-image">Image (Optional)</label>
                        <br><input type="file" id="edit-image" accept="image/*">
                    </div>
                    <br>
                    <div class="form-actions mt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="modal-edit-btn" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const genreList = document.getElementById('genreList');
        const addButton = document.getElementById('addInclusionButton');
        const genreInput = document.getElementById('name');
        const genreDropdown = document.getElementById('genre');
        const addMovieButton = document.getElementById('modal-add-btn');
        const viewButtons = document.querySelectorAll('.view-btn');
        const editButtons = document.querySelectorAll('.edit-btn');
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));

        // Fetch existing genres
        function fetchGenres() {
            fetch('/genres')
                .then(response => response.json())
                .then(data => {
                    genreList.innerHTML = '';
                    data.forEach(genre => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item d-flex justify-content-between align-items-center';
                        li.textContent = genre.name;

                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'btn btn-danger btn-sm';
                        deleteButton.textContent = 'Delete';
                        deleteButton.onclick = () => deleteGenre(genre.id, li);

                        li.appendChild(deleteButton);
                        genreList.appendChild(li);
                    });
                });
        }

        // Add a new genre
        addButton.addEventListener('click', function () {
            const name = genreInput.value.trim();

            if (name === '') {
                alert('Please enter a genre name.');
                return;
            }

            fetch('/genres', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ name }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        genreInput.value = '';
                        fetchGenres();
                    } else {
                        alert(data.message || 'An error occurred.');
                    }
                });
        });

        // Delete a genre
        function deleteGenre(id, listItem) {
            fetch(`/genres/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        listItem.remove();
                    } else {
                        alert(data.message || 'An error occurred.');
                    }
                });
        }

        // Fetch genres for the dropdown
        function fetchDropGenres() {
            fetch('/genres')
                .then(response => response.json())
                .then(data => {
                    genreDropdown.innerHTML = '<option hidden selected>Select Genre</option>';
                    data.forEach(genre => {
                        const option = document.createElement('option');
                        option.value = genre.id;
                        option.textContent = genre.name;
                        genreDropdown.appendChild(option);
                    });
                });
        }

        // Add a movie
        addMovieButton.addEventListener('click', function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('title', document.getElementById('title').value.trim());
            formData.append('release_date', document.getElementById('release-date').value);
            formData.append('ratings', document.getElementById('ratings').value);
            formData.append('duration', document.getElementById('duration').value.trim());
            formData.append('cast', document.getElementById('cast').value.trim());
            formData.append('description', document.getElementById('description').value.trim());
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('genre_id', genreDropdown.value);

            fetch('/movies', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    document.querySelector('form').reset(); // Reset the form
                    $('#addModal').modal('hide'); // Hide the modal
                } else {
                    alert('Failed to add movie. Please check your inputs.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
        
        viewButtons.forEach(button => {
            button.addEventListener('click', async (event) => {
                const movieId = event.target.getAttribute('data-id');

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
            });
        });

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const movieId = button.dataset.id;

                // Fetch movie data using AJAX or Fetch API
                fetch(`/editmovies/${movieId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate the modal fields
                        document.getElementById('edit-title').value = data.title;
                        document.getElementById('edit-genre').value = data.genre_id;
                        document.getElementById('edit-release-date').value = data.release_date;
                        document.getElementById('edit-ratings').value = data.ratings;
                        document.getElementById('edit-duration').value = data.duration;
                        document.getElementById('edit-cast').value = data.cast;
                        document.getElementById('edit-description').value = data.description;

                        // Show the modal
                        editModal.show();
                    })
                    .catch(error => console.error('Error fetching movie data:', error));
            });
        });

        document.getElementById('modal-edit-btn').addEventListener('click', (event) => {
            event.preventDefault();

            const movieId = document.querySelector('.edit-btn[data-id]').dataset.id;
            const formData = new FormData();
            formData.append('title', document.getElementById('edit-title').value);
            formData.append('genre_id', document.getElementById('edit-genre').value);
            formData.append('release_date', document.getElementById('edit-release-date').value);
            formData.append('ratings', document.getElementById('edit-ratings').value);
            formData.append('duration', document.getElementById('edit-duration').value);
            formData.append('cast', document.getElementById('edit-cast').value);
            formData.append('description', document.getElementById('edit-description').value);
            const image = document.getElementById('edit-image').files[0];
            if (image) formData.append('image', image);

            fetch(`/movies/${movieId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Movie updated successfully!');
                        location.reload(); // Reload the page to show updated data
                    } else {
                        alert('Error updating movie.');
                    }
                })
                .catch(error => console.error('Error updating movie:', error));
        });


        // Initial fetch
        fetchDropGenres();
        fetchGenres();
    });
</script>

</body>
</html>