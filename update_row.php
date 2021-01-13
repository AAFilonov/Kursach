<?php 

session_start();
include './restriction.php';
include './functions.php';
  
  if (!empty($_POST)) {


    $array_new = $_POST['new_poles'];
    $array_old = $_POST['old_poles'];
    $array_cols = $_POST['columns'];
    $table = $_POST['table'];

/*
    print_r($array_new);
    print_r($array_old);
  
    print_r( $array_cols);

    */
    $item_arr_new = [];
    $item_arr_old = [];
    for ($i = 0; $i <count ($array_cols); $i++) {
        if($array_new[$i] !=$array_old[$i]){
            if($array_new[$i]!=null)
            $tmpNew=  $array_cols[$i]. "=". "'".$array_new[$i]. "'" ;
            else  $tmpOld =  $array_cols[$i]. "=".  " NULL " ;
         

            $item_arr_new[]=   $tmpNew;
        }


        if($array_old[$i]!=null)
        $tmpOld =  $array_cols[$i]. "=". "'".$array_old[$i]. "'" ;
        else  $tmpOld =  $array_cols[$i]. " is NULL " ;
       $item_arr_old[]= $tmpOld;
    }
    echo join(", ",$item_arr_new);
    //print_r( $item_arr_old);
    $query = "UPDATE $table ". "SET ".join(", ",$item_arr_new) ."WHERE "    . join("and ",$item_arr_old);
   

    $reply = querry_exec($_SESSION['db_name'],$query);
       
    header('Content-Type: application/json');


//print_r($reply);
    echo json_encode($reply);

}
   
?>