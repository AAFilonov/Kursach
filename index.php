<!DOCTYPE html>
<html>

<head>
    <title>Вход</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <form action="connect.php" method="post">
    <p> Адрес сервера: <input type="text" name="server_adr"></p>  
     <p>Имя пользователя:<input type="text" name="user_name">  </p>
     <p> Пароль:<input type="password" name="user_pass"></p> 
     <p> <input type="submit" name="submit"></p>  
    </form>
</body>

</html>