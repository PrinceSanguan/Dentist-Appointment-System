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
            
            <form action="{{route('signup-form')}}" method="post">
                @csrf
                <div class="label-td">
                    <label for="newemail" class="form-label">First Name:</label>
                </div>
                <div class="label-td">
                    <input type="text" name="firstName" class="input-text" placeholder="First Name" required>
                </div>
                <div class="label-td">
                    <label for="newemail" class="form-label">Last Name:</label>
                </div>
                <div class="label-td">
                    <input type="text" name="lastName" class="input-text" placeholder="Last Name" required>
                </div>
                <div class="label-td">
                    <label for="newemail" class="form-label">Email:</label>
                </div>
                <div class="label-td">
                    <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                </div>
                <div class="label-td">
                    <label for="tele" class="form-label">Mobile Number:</label>
                </div>
                <div class="label-td">
                    <input type="number" name="number" class="input-text" placeholder="ex: 09071346898" required min="0">
                </div>
                <div class="label-td">
                    <label class="form-label">Address:</label>
                </div>
                <div class="label-td">
                    <input type="text" name="address" class="input-text" placeholder="Address" required>
                </div>
                <div class="label-td">
                    <label class="form-label">Date of Birth:</label>
                </div>
                <div class="label-td">
                    <input type="date" name="dob" class="input-text" placeholder="Date of Birth" required>
                </div>
                <div class="label-td">
                    <label class="form-label">Create New Password:</label>
                </div>
                <div class="label-td">
                    <input type="password" name="password" class="input-text" placeholder="New Password" required>
                </div>
                
                <div class="label-td">
                    <label class="form-label">Confirm Password:</label>
                </div>
                <div class="label-td">
                    <input type="password" name="password_confirmation" class="input-text" placeholder="Confirm Password" required>
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
