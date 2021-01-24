<?php
//ajax_requests.php
  session_start();
  include './restriction.php';
  include './functions.php';
  
  if (!empty($_POST)) {

    $query = $_POST['request'];

    $reply = querry_exec($_SESSION['db_name'],$query);
       
    header('Content-Type: application/json');
    echo json_encode($reply);

    
   
   
  }
?>