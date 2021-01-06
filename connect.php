<?php

if (isset($_POST['submit'])) {

    session_start();
    if (!isset($_SESSION['count'])) {
      $_SESSION['count'] = 0;
    } else {
      $_SESSION['count']++;
    }

    $user = "root";
    $password = "";
    $server_adr = "127.0.0.1";
    try {
        $db = mysqli_connect($server_adr, $user, $password);
        echo "db is connected";
        $_SESSION['logged'] = "true";
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        $_SESSION['server_adr'] = $server_adr;
       
     

      

        header("Location: db_list.php");
       
        
    } catch (Exception $e) {
        echo "db is not connected";
        echo $e->getMessage();
    }
}
else{
    echo "smth got wrong";
}
