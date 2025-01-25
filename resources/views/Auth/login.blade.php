<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome.min.css')}}">
    <style>
        h2{
            font-family: 'Arial';
            font-size: 1rem;
        }
        body {
            background: linear-gradient(190deg, #6592F3, #3B558D);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .btn{
            background: #19315D;
            border-color: #3B558D;
        }
        .login-container {
            color: white;
            background: linear-gradient(45deg,rgb(29, 69, 104),#19315D);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: auto;
        }

        .container {
            background-color: white;
            margin-top: 10px;
            padding: 0 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: auto;
        }
        .main{
            display: flex;
            flex-direction: column;
        }
        .forgot{
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="login-container">
            <h2 class="text-center mb-4">Lanmar Resort</h2>
            @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger" style="font-size: 15px;">{{$error}}</div>
                @endforeach
            @elseif (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{route('loginAccess')}}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>

        <div class="container">
            <p class="mt-3 text-center">Don't have an account? <a href="{{route('register')}}">Sign up here</a></p>
        </div>
    </div>
</body>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script src="{{asset('assets/js/fontawesome.min.js')}}"></script>
</html>