<!DOCTYPE html>
<html>


<head>
    <title>Просмотр таблицы</title>
    <style type="text/css">
    table,
    th,
    td {
        border: 1px solid black;
    }
    #edit_form input{
        display: block;
    }
    </style>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script  type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
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
    <div id="edit_querry_block">
        <textarea name="" id="querry_text" cols="30" rows="10"></textarea>
        <p><button id="send_querry">Отправить</button> </p>
    </div>

    <div id="result_block">

    </div>
   
    <form id="edit_form"></form>
    <button id="add_form" >Добавить</button>
    <button id="save_form" disabled="true">Сохранить</button>

    
    <table id='object_table'>
    </table>
    


</div>



    <script src="../js/script.js"> </script>
    <script src="../js/table_view.js"> </script>
</body>

</html>