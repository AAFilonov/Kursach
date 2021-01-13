<!DOCTYPE html>
<html>

<head>
    <title>Вход</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container ">
        <div class="row ">
            <div class="col-md-3"></div>
            <div class="col-md-6  justify-content-around align-items-center">
                <div>
                    <h2>Авторизация</h2>
                    <form action="connect.php" method="post">
                        <p> Адрес сервера:</p>
                        <p><input type="text" name="server_adr"></p>
                        <p>Имя пользователя:</p>
                        <p><input type="text" name="user_name"> </p>
                        <p> Пароль:</p>
                        <p><input type="password" name="user_pass"></p>
                        <p> <input type="submit" name="submit"></p>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

</body>

</html>