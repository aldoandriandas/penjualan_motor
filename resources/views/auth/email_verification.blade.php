<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Verifikasi Email</h1>
    <p>untuk melakukan verifikasi</p>
    <div>
        <p><strong>Email</strong>{{$email}}</p>
        <p><strong>Password</strong>{{$password}}</p>
    </div>

    <a href="{{route('auth.verifyAccount', $token)}}">
        Verifikasi Email
    </a>


</body>
</html>