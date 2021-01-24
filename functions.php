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
function fillColumnInfo($db_name,$table){
    $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password'],$db_name);
    $querry_col = "SELECT COLUMN_NAME
    , DATA_TYPE 
    ,NUMERIC_PRECISION
    ,CHARACTER_MAXIMUM_LENGTH
    ,IS_NULLABLE
    ,COLUMN_KEY
   
    ,EXTRA
    ,COLUMN_DEFAULT 
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$table';";
   //echo $querry ." <br>";
    $column_set = mysqli_query($db, $querry_col);
    if( !$column_set=== false){
        while ($db = mysqli_fetch_row($column_set)){   
            $dbs[] = $db;
        
        }
    }
   //print_r($dbs);
    echo "<h3>Columns:</h3>";
    echo "<table class='table'>";
        echo "<tr>
         <th>column</th>
         <th>data type</th>
         <th>is nullable</th>
         <th>key</th>
         <th>increment</th>

         <th>default value</th>
         </tr>";
    foreach ($dbs as $i){
        $s= "<tr>";
        // COLUMN_NAME
        $s = $s ."<td>". $i[0].  "</td>";
        //DATA_TYPE + (length)
        $s = $s ."<td>". $i[1]."(";
        if($i[2]!=NULL||$i[2]="")  $s = $s .($i[2]+1);
        if($i[3]!=NULL||$i[3]="")  $s = $s .$i[3];
         $s = $s .")</td>";
        //IS_NULLABLE
        $s = $s ."<td><input type='checkbox'  ";
        if($i[4]=="YES")  
            $s = $s . "checked='checked'";       
        $s = $s ."</></td>";

        //COLUMN_KEY
        if($i[5]== NULL)   $s = $s ."<td>"."NULL" ."</td>";
        else $s = $s ."<td>". $i[5]."</td>";
        //INCREMENT
        $s = $s ."<td><input type='checkbox'  ";
        if( $i[6]=="auto_increment")  
          $s = $s . "checked='checked'";       
        $s = $s ."</></td>";
        //DEFAULT VALUE
        $s = $s ."<td>". $i[7]."</td>";
        $s = $s ."</tr>";
        echo $s;
    }
    echo "</table>";
}
function fillFKInfo($db_name,$table){
  //  mysqli_report(MYSQLI_REPORT_ALL);
   
    $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password'],$db_name);
    $querry_col = "SELECT `column_name`, 
    `referenced_table_name` AS foreign_table, 
    `referenced_column_name`  AS foreign_column 
FROM
    `information_schema`.`KEY_COLUMN_USAGE`
WHERE
    `constraint_schema` = SCHEMA()
AND
    `table_name` = '$table'
AND
    `referenced_column_name` IS NOT NULL
ORDER BY
    `column_name`;";
    $column_set = mysqli_query($db, $querry_col);
    if( !$column_set=== false){
        $dbs = mysqli_fetch_all($column_set);
    }
    //print_r($dbs);
    echo "<h3>Foreign keys:</h3>";
    echo "<table  class='table'>";
    echo "<tr>
     <th>column</th>
     <th>foreign table</th>
     <th>foreign column</th>  
     </tr>";
foreach ($dbs as $i){
    $s= "<tr>";
    $s = $s ."<td>". $i[0].  "</td>";
    $s = $s ."<td>". $i[1].  "</td>";
    $s = $s ."<td>". $i[2].  "</td>";
    $s = $s ."</tr>";
    echo $s;
}
echo "</table>";

}
function querry_exec($db_name,$query){
    $reply = array();
    mysqli_report(MYSQLI_REPORT_STRICT |MYSQLI_REPORT_ERROR);
    try{
        $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password'],$db_name);
    }
    catch(Exception $e){
        $reply['error']= "Connect error: ". $e->getMessage();
        return $reply;
    }
    try{
        $set = mysqli_query($db,$query );
        if($set=== true){
            $reply['info']="Operation succesful";}
        else if( ! $set=== false){
            $dbs =  mysqli_fetch_all($set);
             $reply['data']=  $dbs;
             $reply['columns'] = mysqli_fetch_fields($set);
            // print_r($set);
             $set->close();
        }
        else $reply['error']="something gone wrong";            
    }  
    catch(Exception $e){
        $reply['error']= "Query error: ". $e->getMessage();
    }
    catch(RuntimeException $e){
        $reply['error']= "Mysqli error: ". $e->getMessage();
    }
    finally{
        //mysqli_close($db);      
    }
    $reply['query'] = $query;
    return $reply;
}
?>