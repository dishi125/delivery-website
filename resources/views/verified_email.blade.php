<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Email Verification Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron bg-white text-center">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead  @if($user==1) text-success "><strong>Email Verified @else text-danger" ><strong>Email verification fail.@endif</strong></p>
    <hr>
    <p class="lead">
        <a class="btn " style="background-color: #FFC56C;color: white;" href="{{ url('signin') }}" role="button">Continue to Home</a>
    </p>
</div>

</body>
</html>
