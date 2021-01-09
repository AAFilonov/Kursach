<!DOCTYPE html>
<html>


<head>
    <title>Редактирование таблицы</title>
    <style type="text/css">
    table,
    th,
    td {
        border: 1px solid black;
    }
    </style>
</head>

<body>






    <?php
session_start();
include '../restriction.php';
include '../functions.php';


if (!empty($_GET['table'])) {
    //если некорректное 
    if (!isTableNameValid($_GET['db'],$_GET['table'])){
        die("Таблицы с именем " .$_GET['table']."не существует<br>"); 
    }  
    //редактировать существующую
    echo "<h2>Table ".$_GET['table'].":</h2>";
    $_SESSION['isNewTable']=false;
    fillColumnInfo($_GET['db'],$_GET['table']);
    fillFKInfo($_GET['db'],$_GET['table']);
  
}
  
else{
    //создание новой таблицы
    echo "<h2>New table:</h2>";
    $_SESSION['isNewTable']=true;
    }

    ?>


    <p><button id="button_edit">Редактировать</button> </p>
    <div id="edit_querry_block">
        <textarea name="" id="" cols="30" rows="10"></textarea>
        <p><button id="send_querry">Отправить</button> </p>
    </div>



</body>

</html>