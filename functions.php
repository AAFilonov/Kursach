<?php
function isDbNameValid($db_name):bool{
    
    $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password']);
    $set = mysqli_query($db, 'SHOW DATABASES;');
    $dbs = array();
    while ($db = mysqli_fetch_row($set))
    $dbs[] = $db[0];
    return in_array($db_name,$dbs);
}
function isTableNameValid($db_name, $table_name):bool{
 
    $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password']);
    $set = mysqli_query($db, 'SHOW TABLES FROM '.$db_name .';');
    $dbs = array();
 
    while ($db = mysqli_fetch_row($set))
        $dbs[] = $db[0];
      //  print_r($dbs);
    return in_array( $table_name,$dbs);
}


?>