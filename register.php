<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --main-color: #c0392b;
            --body-bg: #181616;
            --box-bg: #221f1f;
            --text-color: #ffffff;
        }

        body {
            margin-top: 30px;
            font-family: "Cairo", sans-serif;
            background-color: var(--body-bg);
            color: var(--text-color);
            padding-top: var(--nav-height);
        }

        .register-container {

            background-color: var(--box-bg);
            padding: 40px;
            border-radius: 10px;
            max-width: 450px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .register-container h1 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--text-color);
        }

        .register-container .main-color {
            color: var(--main-color);
        }

        .register-container form input {
            width: 100%;
            height: 20px;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: var(--body-bg);
            color: var(--text-color);
        }

        .register-container form input::placeholder {
            color: #aaa;
        }

        .register-container form button {
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

        .register-container form button:hover {
            background-color: #e74c3c;
        }

        .register-container p {
            text-align: center;
            margin-top: 5px;
            margin-bottom: -10px;
        }

        .register-container p a {
            color: var(--main-color);
            text-decoration: none;
        }

        .register-container p a:hover {
            text-decoration: underline;
        }



        button {
            background: #19315D;
            border-color: #3B558D;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1><span class="main-color">R</span>egistration <span class="main-color">F</span>orm</h1>

        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @elseif($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        <form action="{{route('make_register')}}" method="POST">
            @csrf
            <label for="firstname">First Name</label><input type="text" id="firstname" name="firstname" placeholder="First Name" required>
            <label for="lastname">Last Name</label><input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
            <label for="username">Username</label><input type="text" id="username" name="username" placeholder="Username" required>
            <label for="email">Email</label><input type="email" id="email" name="email" placeholder="Email" required>
            <div id="email-error-message"></div>
            <label for="password">Password</label><input type="password" id="password" name="password" placeholder="Password" required>
            <p id="message" style="display: none; font-size: 10px; margin-top: -5px; text-align: left;">
                <span id="strength"></span>
            </p>
            <label for="password_confirmation">Confirm Password</label><input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit" name="register" id="submitButton"><b>Register</b></button>
            <p>Already have an account? <a href="{{route('login')}}"><b>Login here</b></a></p>
        </form>
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var pass = document.getElementById("password");
        var confirmPass = document.querySelector('input[name="password_confirmation"]');
        var msg = document.getElementById("message");
        var strength = document.getElementById("strength");
        var submitButton = document.querySelector('button[type="submit"]');
        var firstName = document.getElementById("firstname");
        var lastName = document.getElementById("lastname");
        var emailInput = document.getElementById("email");
        var emailErrorMessage = document.getElementById("email-error-message");
        const namePattern = /^[A-Za-z\s]+$/;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        // Add new element for confirm password message
        var confirmMsg = document.createElement("p");
        confirmMsg.id = "confirmMessage";
        confirmMsg.style.display = "none";
        confirmMsg.style.fontSize = "10px";
        confirmMsg.style.marginTop = "-5px";
        confirmMsg.style.textAlign = "left";
        confirmPass.parentNode.insertBefore(confirmMsg, confirmPass.nextSibling);

        function validateName(inputField) {
            const value = inputField.value;
            if (!namePattern.test(value)) {
                inputField.style.borderColor = "#ff5925";
                inputField.style.borderWidth = "2px";
                submitButton.disabled = true;
            } else {
                inputField.style.borderColor = "#26d730";
                inputField.style.borderWidth = "2px";
                submitButton.disabled = false;
            }
        }

        // Add event listener for confirm password
        confirmPass.addEventListener("input", () => {
            confirmMsg.style.display = "block";
            if (pass.value !== confirmPass.value) {
                confirmPass.style.borderColor = "#ff5925";
                confirmMsg.innerHTML = "Passwords do not match!";
                confirmMsg.style.color = "#ff5925";
                submitButton.disabled = true;
            } else {
                confirmPass.style.borderColor = "#26d730";
                confirmMsg.innerHTML = "Passwords match!";
                confirmMsg.style.color = "#26d730";
                // Check if password is also strong enough
                checkPasswordStrength();
            }
        });

        // Password strength checker
        function checkPasswordStrength() {
            const hasUpperCase = /[A-Z]/.test(pass.value);
            const hasLowerCase = /[a-z]/.test(pass.value);
            const hasNumbers = /\d/.test(pass.value);
            const hasSymbols = /[!@#$%^&*(),.?":{}|<>]/.test(pass.value);

            if (pass.value.length > 0) {
                msg.style.display = "block";
            } else {
                msg.style.display = "none";
                submitButton.disabled = true;
                return;
            }

            if (pass.value.length < 5 || !hasUpperCase || !hasLowerCase || !hasNumbers) {
                strength.innerHTML = "Password is Weak (Requires uppercase, lowercase, numbers)";
                pass.style.borderColor = "#ff5925";
                msg.style.color = "#ff5925";
                strength.style.color = "#ff5925";
                submitButton.disabled = true;
            } else if (pass.value.length >= 5 && pass.value.length < 8) {
                strength.innerHTML = "Password is Medium (Consider using a longer password)";
                pass.style.borderColor = "#FFA500";
                msg.style.color = "#FFA500";
                strength.style.color = "#FFA500";
                submitButton.disabled = true;
            } else if (pass.value.length >= 8 && hasUpperCase && hasLowerCase && hasNumbers) {
                strength.innerHTML = "Password is Strong";
                pass.style.borderColor = "#26d730";
                msg.style.color = "#26d730";
                strength.style.color = "#26d730";
                // Only enable submit if passwords also match
                submitButton.disabled = !(pass.value === confirmPass.value);
            }
        }

        // Add event listener for password
        firstName.addEventListener("input", function() {
            validateName(firstName);
        });

        lastName.addEventListener("input", function() {
            validateName(lastName);
        });
        pass.addEventListener("input", checkPasswordStrength);

        emailInput.addEventListener("input", function() {
            const value = emailInput.value;

            if (!emailPattern.test(value)) {
                emailInput.style.borderColor = "#ff5925";
                emailErrorMessage.textContent = "Invalid email format.";
                emailErrorMessage.style.color = "#ff5925";
                emailErrorMessage.style.fontSize = "10px";
                emailErrorMessage.style.textAlign = "left";
            } else {
                emailInput.style.borderColor = "#26d730";
                emailErrorMessage.textContent = "";
            }
        });

    });
</script>
</body>
</html>
