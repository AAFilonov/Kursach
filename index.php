<!DOCTYPE html>
<html>

<head>
    <title>Авторизация пользователя</title>
</head>

<body>
<?php
echo "php is OK"
    ?>
    <form action="connect.php" method="post">
    <p> Адрес сервера: <input type="text" name="server_adr"></p>
  
     <p>Имя пользователя:<input type="text" name="user_name">  </p>
     <p> Пароль:<input type="password" name="user_pass"></p> 
     <p> <input type="submit" name="submit"></p>  
    </form>
</body>

</html>