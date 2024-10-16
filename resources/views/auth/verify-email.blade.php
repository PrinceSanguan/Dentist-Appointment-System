<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="alert alert-info">
        Please verify your email address. We’ve sent you a verification link.
    </div>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>
  </div>
</body>
</html>

