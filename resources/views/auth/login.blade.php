<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Halaman Login</h1>
    <form action="/login" method="post">
        @csrf
        <input type="email" name="email" placeholder="Masukan Email"><br>
        <input type="password" name="password" placeholder="Masukan Password"><br>
        <button type="submit">Login</button>
        <a href="{{route('register')}}">Register</a>
    </form>
</body>

</html>
