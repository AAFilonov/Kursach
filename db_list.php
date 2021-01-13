

<!DOCTYPE html>
<html>

<head>
    <title>Список баз данных</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <div class="col-md-12">
    <h2> Список баз данных</h2>
    <table  class="table">
    <?php 
        session_start();
        include 'restriction.php';


        $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password']);
        $set = mysqli_query($db, 'SHOW DATABASES;');
        $dbs = array();
        

      
        echo "<tr>
         <th scope='col'>База данных</th>
         <th scope='col'></th>         
         </tr>";
        while ($db = mysqli_fetch_row($set))
            $dbs[] = $db[0];
        foreach ($dbs as $i) {
            echo "<tr><td>" . $i . "</td><td><a href='DB/db_view.php?db=".$i."'>Смотреть</a><td></tr>";
        }
     
        ?>

    </table>
    </div>
    </div>
</body>

</html>