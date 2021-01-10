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
    <script src="../js/jquery-3.5.1.min.js"></script>
</head>

<body>






    <?php
session_start();
include '../restriction.php';
include '../functions.php';

echo "<a href='db_view.php?db=".$_GET['db']."'>Назад</a>";
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
        <textarea name="" id="querry_text" cols="30" rows="10"></textarea>
        <p><button id="send_querry">Отправить</button> </p>
    </div>

    <div id="result_block">

    </div>



    <script src="../js/script.js" > </script>
    <script src="../js/decoration.js" > </script>

</body>

</html>