<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/animations.css')}}">
    <link rel="stylesheet" href="{{asset('css/finalmain.css')}}">
    <link rel="stylesheet" href="{{asset('css/signup.css')}}">
    <title>Create Account</title>

</head>
<body>

<div class="main-container">
    <div class="form-container">
        <p class="header-text">Start Creating Your User Account</p>
        <p class="sub-text">Make Sure You Remember Your Login Information.</p>
        <div class="form-body">
            <form action="" method="POST">
                <div class="label-td">
                    <label for="newemail" class="form-label">Email:</label>
                </div>
                <div class="label-td">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </div>
                <div class="label-td">
                    <label for="tele" class="form-label">Mobile Number:</label>
                </div>
                <div class="label-td">
                    <input type="tel" name="tele" class="input-text" placeholder="ex: 09071346898" pattern="[0]{1}[0-9]{9}">
                </div>
                <div class="label-td">
                    <label for="newpassword" class="form-label">Create New Password:</label>
                </div>
                <div class="label-td">
                    <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                </div>
                <div class="label-td">
                    <label for="cpassword" class="form-label">Confirm Password:</label>
                </div>
                <div class="label-td">
                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required>
                </div>
                <div>


                <div>
                    <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                </div>
            </form>
            <div>
                <br>
                <label for="" class="sub-text">Already have an account? </label>
                <a href="{{route('signin')}}" class="hover-link1">Login</a>
                <br><br><br>
            </div>
        </div>
    </div>
</div>
</body>
</html>
