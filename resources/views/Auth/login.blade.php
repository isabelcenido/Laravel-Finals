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
        :root {
            --main-color: #c0392b;
            --body-bg: #181616;
            --box-bg: #221f1f;
            --text-color: #ffffff;
        }

        body {
            margin-top: 120px;
            font-family: "Cairo", sans-serif;
            background-color: var(--body-bg);
            color: var(--text-color);
        }

        .login-container {
            background-color: var(--box-bg);
            padding: 40px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .login-container h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--text-color);
        }

        .login-container .main-color {
            color: var(--main-color);
        }

        .login-container form input {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: var(--body-bg);
            color: var(--text-color);
        }

        .login-container form input::placeholder {
            color: #aaa;
        }

        .login-container form button {
            width: 100%;
            padding: 5px;
            background-color: var(--main-color);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container form button:hover {
            background-color: #e74c3c;
        }

        .login-container p {
            text-align: center;
            margin-top: 5px;
            margin-bottom: -10px;
        }

        .login-container p a {
            color: var(--main-color);
            text-decoration: none;
        }

        .login-container p a:hover {
            text-decoration: underline;
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
            <h1 class="text-center mb-4"><span class="main-color">L</span>ogin</h1>

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
                <button type="submit" name="submit" class="btn btn-primary w-100"><b>Login</b></button>
                <p class="mt-3 text-center">Don't have an account? <a href="{{route('register')}}"><b>Sign Up here</b></a></p>
            </form>
        </div>

    </div>
</body>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script src="{{asset('assets/js/fontawesome.min.js')}}"></script>
</html>