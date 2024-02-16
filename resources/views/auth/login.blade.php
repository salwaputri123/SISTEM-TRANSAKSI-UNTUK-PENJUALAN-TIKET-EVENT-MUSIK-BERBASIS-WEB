<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/login/style.css" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="/prosesLogin" method="POST">
                @csrf
                <h1>Login</h1>
                <div id="alertLogin" style="margin-top: 20px; padding: 15px;"></div>
                <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" />
                <input type="password" id="password" name="password" placeholder="Password" />
                <a href="#">Lupa Password?</a>
                <button type="button" id="btnLogin">Login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Selamat Datang!</h1>
                    <p>Silahkan Masukan Email dan Password Untuk Masuk Kedalam Aplikasi.</p>
                    <button type="button" class="ghost" id="signUp">Daftar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/assets/login/script.js"></script>
</body>

</html>