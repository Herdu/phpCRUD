<?php
    require_once("db_data.php");

    session_start();
    if (!isset($_SESSION['isLogged']))
        header("location: index.php");

if (!isset($_SESSION['isAdmin']))
    header("location: crud.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>



    <link rel="stylesheet" type="text/css" href="../style.css">

</head>
<body>


<table>
    <tr>
        <td>Id</td> <td>Login</td> <td>Hasło</td><td></td>
    </tr>


<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 13.03.17
 * Time: 18:27
 */



function getRealPOST() {
    $pairs = explode("&", file_get_contents("php://input"));
    $vars = array();
    foreach ($pairs as $pair) {
        $nv = explode("=", $pair);
        $name = urldecode($nv[0]);
        $value = urldecode($nv[1]);
        $vars[$name] = $value;
    }
    return $vars;
}


$_POST = getRealPOST();





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['id'];


    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($mysqli->connect_errno) {
        echo "failed to connect to mysql: " . $mysqli->connect_error;
    } else {
        $query = "SELECT * FROM users where id={$id}";
        $res = $mysqli->query($query);


        echo "<tr>";


        while ($row = $res->fetch_assoc()) {
            echo "<form method='post' action='confirmUpdateUser.php'>";
            echo "<td>";
            echo $row['id'];
            echo "<input type='hidden' name='newid' value='{$row['id']}' '>";
            echo "</td><td>";
            echo $row['login'];
            echo "</td><td>";
            echo "<input type='text' name='newpassword' value='{$row['password']}' '>";
            echo "</td><td>";
            echo "<input type='submit' value='zapisz'>";
            echo "</form>";
        }
        echo "</tr>";
        echo "</td>";
        echo "</table>";


        $mysqli->close();
    }


}

?>



<a href="../admin.php"><button>Wróć</button></a>

</body>
</html>


