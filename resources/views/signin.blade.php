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
            <form action="" method="POST">
                <div class="label-td">
                    <label for="useremail" class="form-label">Email:</label>
                </div>
                <div class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                </div>
                <div class="label-td">
                    <label for="userpassword" class="form-label">Password:</label>
                </div>
                <div class="label-td">
                    <input type="password" name="userpassword" class="input-text" placeholder="Password" required>
                </div>
                <div>

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

</body>
</html>
