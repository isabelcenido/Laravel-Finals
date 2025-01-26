<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(190deg, #6592F3, #3B558D);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333333;
        }
        .register-container {
            color: white;
            background: linear-gradient(45deg,rgb(29, 69, 104),#19315D);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            text-align: center;
            font-family: 'nautigal';
            font-size: 3rem;
            font-weight: normal;
            margin: 0;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
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
        <h2>Register Form</h2>
        <p>Register Here</p>
        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @elseif($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif
        <form action="{{route('make_register')}}" method="POST">
            @csrf
            <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
            <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <div id="email-error-message"></div>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <p id="message" style="display: none; font-size: 10px; margin-top: -5px; text-align: left;"><span id="strength"></span></p>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit" name="register" id="submitButton">Register</button>
            <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
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
