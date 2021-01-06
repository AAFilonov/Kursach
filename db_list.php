

<!DOCTYPE html>
<html>

<head>
    <title>Список баз данных</title>
</head>

<body>
    <h2> Список баз данных</h2>
    <table>
    <?php 
        session_start();
        include 'restriction.php';


        $db = mysqli_connect($_SESSION['server_adr'],  $_SESSION['user'],  $_SESSION['password']);
        $set = mysqli_query($db, 'SHOW DATABASES;');
        $dbs = array();
        
        while ($db = mysqli_fetch_row($set))
            $dbs[] = $db[0];
        foreach ($dbs as $i) {
            echo "<tr><td>" . $i . "</td><td><a href=#>Смотреть</a><td></tr>";
        }
        ?>

    </table>
</body>

</html>