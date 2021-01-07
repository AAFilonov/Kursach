<!DOCTYPE html>
<html>
<?php
session_start();
include '../restriction.php';
include '../functions.php';
$db_name = $_GET['db'];

if(!isDbNameValid($db_name)){
    die("DB name is no valid");
}
$_SESSION['db_name']=$db_name;

?>

<head>
    <?php //название базы
    echo"<title>".$_SESSION['db_name'] ." database </title>" ?>
</head>

<body>
    <?php echo"<h1>".$_SESSION['db_name'] ." database </h1>" ?>
    <a href="../db_list.php">Назад</a>
    <h2>Список таблиц:</h2>
    <table>

        <?php 
    $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password']);
    $set = mysqli_query($db, 'SHOW TABLES FROM '.$_SESSION['db_name'] .';');
    $dbs = array();
    
    while ($db = mysqli_fetch_row($set))
        $dbs[] = $db[0];
      
        //print_r($dbs);   
    foreach ($dbs as $i) {
        echo "<tr><td>" . $_SESSION['db_name'] . "</td>
        <td><a href='table_view.php?db=".$_SESSION['db_name']."&table=".$i ."'>Смотреть</a></td>
        <td><a href='table_edit.php?db=".$_SESSION['db_name']."&table=".$i ."'>Редактировать</a></td>
        </tr>";
    }
    ?>

    </table>
    <p>
        <?php
      echo "   <a href='table_edit.php?db=".$_SESSION['db_name']."&table= '>Создать таблицу</a>";
 
    ?>
    </p>

</body>

</html>