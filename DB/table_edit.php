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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>



    <div class="container">

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
    ?>
        <div class="row">

            <div class="col-md-7">
                <?php fillColumnInfo($_GET['db'],$_GET['table']);?>
            </div>
            <div class="col-md-5">
                <?php  fillFKInfo($_GET['db'],$_GET['table']);}?>
            </div>
            <div class="col-md-7">






                <p><button id="button_edit">Редактировать</button> </p>


                <div id="edit_querry_block">
                    <textarea name="" id="querry_text" cols="30" rows="10" style="height: 130px;"></textarea>
                    <p><button id="send_querry">Отправить</button> </p>
                </div>

                <div id="result_block">

                </div>
            </div>
        </div>

    </div>

    <script src="../js/script.js"> </script>
    <script src="../js/decoration.js"> </script>

</body>

</html>