<!DOCTYPE html>
<html>


<head>
    <title>Редактирование таблицы</title>
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
    echo "Редактирование " .$_GET['table'];
}
  
else{
    //создание новой таблицы
    echo "создание новой";
    }
    ?>




</body>

</html>