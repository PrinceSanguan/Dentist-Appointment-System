<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/animations.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/signin.css')}}">
    <title>Login</title>
    
</head>
<body>
    <div class="container">
        <a href="{{route('welcome')}}" class="hover-link1" style="float: left;">Back</a>
        <p class="header-text">Welcome Back!</p>
        <p class="sub-text">Login with your details to continue</p>
        <div class="form-body">

            <form action="{{route('login-form')}}" method="post">
                @csrf
                <div class="label-td">
                    <label for="useremail" class="form-label">Email:</label>
                </div>
                <div class="label-td">
                    <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                </div>
            
                <div class="label-td">
                    <label for="userpassword" class="form-label">Password:</label>
                </div>
                <div class="label-td password-container">
                    <input type="password" name="password" id="password" class="input-text" placeholder="Password" required>
                    <span class="toggle-eye" onclick="togglePassword()">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 3a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            <path d="M8 5a3 3 0 0 0 0 6 3 3 0 0 0 0-6z"/>
                        </svg>
                    </span>
                </div>
            
                <div>
                    <input type="submit" value="Login" class="login-btn">
                </div>
            </form>

            <div>
                <br>
                <label for="" class="sub-text">Don't have an account? </label>
                <a href="{{route('signup')}}" class="hover-link1">Sign Up</a>

                <br><br><br>
            </div>
        </div>
    </div>

<!----Sweet Alert---->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      @if (session('success'))
          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('success') }}',
              confirmButtonText: 'OK'
          });
      @endif

      @if (session('error'))
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '{{ session('error') }}',
              confirmButtonText: 'Try Again'
          });
      @endif
  });
</script>

<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.innerHTML = `<path d="M16 8s-3 5.5-8 5.5S0 8 0 8s3-5.5 8-5.5S16 8 16 8zm-8 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path d="M3.05 7a6.978 6.978 0 0 1 1.3-2.828 1 1 0 1 0-1.714-1.03A8.978 8.978 0 0 0 .29 8.01l.658.658A8.978 8.978 0 0 0 2.636 9.07a1 1 0 1 0 1.03-1.714A6.978 6.978 0 0 1 3.05 7z"/>`;
        } else {
            passwordField.type = "password";
            eyeIcon.innerHTML = `<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 3a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>`;
        }
    }
</script>

<style>
    .password-container {
        position: relative;
    }
    .toggle-eye {
        position: absolute;
        right: 10px;
        top: 35%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>

</body>
</html>
