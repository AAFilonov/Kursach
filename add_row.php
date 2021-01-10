<?php 

session_start();
include './restriction.php';
include './functions.php';
  
  if (!empty($_POST)) {

    $array_new = $_POST['new_poles'];
    $array_cols = $_POST['columns'];
    $table = $_POST['table'];

    //print_r($array_new);
    $item_arr_new = [];
    for ($i = 0; $i <count ($array_new); $i++) {
        if($array_new[$i]==null ||$array_new[$i]=='' )
            $tmpNew =  "NULL" ;
        else $tmpNew =    "'".$array_new[$i]. "'" ;         
        array_push($item_arr_new, $tmpNew); 
    }
 
    $query = "INSERT INTO $table (". join(",",$array_cols) .")" 
    . "VALUES (". join(",",$item_arr_new).")";
   //echo "Q:".$query;

    $reply = querry_exec($_SESSION['db_name'],$query);
       
    header('Content-Type: application/json');


//print_r($reply);
    echo json_encode($reply);

}
   
?>