
<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 13.03.17
 * Time: 18:27
 */
session_start();

if (!isset($_SESSION['isLogged']))
    header("location: index.php");

require_once("db_data.php");

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





if ($_SERVER['REQUEST_METHOD'] == "POST"){



    $id = $_POST['id'];

    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($mysqli->connect_errno)
    {
        echo "failed to connect to mysql: ". $mysqli->connect_error;
    }

    else
    {
        $query = "DELETE FROM {$_SESSION['table']} WHERE id=$id;";

        $mysqli->query($query);
        $mysqli->close();
    }

}





header("location: ../crud.php");
?>



