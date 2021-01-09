<!DOCTYPE html>
<html>


<head>
    <title>Просмотр таблицы</title>
</head>

<body>
    <?php
    session_start();
    include '../restriction.php';
    include '../functions.php';


    if(!isDbNameValid($_GET['db'])){
        die("DB name is no valid");
    }
    if (empty($_GET['table']) || !isTableNameValid($_GET['db'],$_GET['table'])){

        die("Таблицы с именем " .$_GET['table']." не существует<br>");
        
    }  
    else{
        echo "<a href='db_view.php?db=".$_GET['db']."'>Назад</a>";
    echo "<h2> Таблица ".$_GET['table'].":</h2>";  } ?>
    <table>
<?php 
    try{
        
        //mysqli_report(MYSQLI_REPORT_ALL);
        
        $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password'],$_SESSION['db_name']);
        $table = $_GET['table'];
        $db_name = $_GET['db'];

        $querry_col = "SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$table';";
       //echo $querry ." <br>";

        $column_set = mysqli_query($db, $querry_col);
        //print_r($column_set);
        if( !$column_set=== false){
            while ($db = mysqli_fetch_row($column_set))
                $dbs[] = $db[0];

            //print_r($dbs);
            echo "<tr>";
            foreach ($dbs as $i) {            
               
            echo " <th>" . $i . "</th>";
        
            }
            echo "</tr>";
        }
        else{
            echo 'error  while getting columns info';
        }


        $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password'],$_SESSION['db_name']);
        $querry = " select "." *" . " from `$table`;";
           // echo $querry ." <br>";
           
        $set = mysqli_query($db, $querry);
        if( !$set=== false){
         
            $dbs = array();
            //print_r($set);
            while ($db = mysqli_fetch_row($set))
                $dbs[] = $db;
                //print_r($dbs);
            foreach ($dbs as $i) {
               echo "<tr>";
                foreach ($i as $j) 
                    echo " <td>" . $j . "</td>";
                echo "</tr>";
            }
        }  
        else{
            echo "somethnig gone wrong"; 
        } 
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
?>


    </table>








</body>

</html>