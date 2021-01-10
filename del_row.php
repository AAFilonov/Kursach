<?php 

session_start();
include './restriction.php';
include './functions.php';
  if (!empty($_POST)) {


    $array_old = $_POST['old_poles'];
    $array_cols = $_POST['columns'];
    $table = $_POST['table'];



   
    //print_r( $array_old);
    //print_r( $array_cols);
  
    $item_arr_old = [];
    for ($i = 0; $i <count ($array_old); $i++) {   
        if($array_old[$i]!=null)
        $tmpOld =  $array_cols[$i]['name']. "=". "'".$array_old[$i]. "'" ;
        else  $tmpOld =  $array_cols[$i]['name']. " is NULL " ;
        array_push($item_arr_old, $tmpOld);

    }
 
    $query = "DELETE FROM $table"." WHERE ". join("and ",$item_arr_old);
   // echo "Q:".$query;

    $reply = querry_exec($_SESSION['db_name'],$query);
       
    header('Content-Type: application/json');


//print_r($reply);
    echo json_encode($reply);

}
   
?>