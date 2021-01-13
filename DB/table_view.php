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

    #edit_form div {
        display: block;
    }
    </style>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<body>
    <div class="container">
        <div class="row align-items-center">
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
    
     echo "<h2> Таблица ".$_GET['table']."";  } 
     echo "<a href='db_view.php?db=".$_GET['db']."'> (назад)</a></h2>";?>



        </div>
        <div class="row">
            <div class="col-md-5">
                <div id="edit_querry_block">
                    <textarea name="" id="querry_text" cols="30" rows="10" style="height: 130px;"></textarea>
                    <p><button id="send_querry">Отправить</button> </p>
                </div>

                <div id="result_block">

                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-5 card align-items-center">
                    <form id="edit_form"></form>
                    <div class="align-items-centeralign-items-center">
                        <button class="btn btn-primary" id="add_form">Добавить</button>
                        <button class="btn btn-primary" id="save_form" disabled="true">Сохранить</button>
                    </div>
                </div>

                <table class="table " id='object_table'>
                </table>
            </div>
        </div>

    </div>


    </div>
    <script src="../js/script.js"> </script>
    <script src="../js/table_view.js"> </script>
</body>

</html>