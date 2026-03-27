<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Halaman Register</h1>
    <form method="POST" action="/register">
        @csrf

        <input type="text" name="name" placeholder="Nama"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Register</button>
        <a href="{{route('login')}}">Login</a>
    </form>

</body>

</html>
