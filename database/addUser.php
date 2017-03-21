
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

if (!isset($_SESSION['isAdmin']))
    header("location: crud.php");




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


    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if($mysqli->connect_errno)
    {
        echo "failed to connect to mysql: ". $mysqli->connect_error;
    }

    else
    {

        $query = "INSERT INTO users ( login, password, role ) VALUES ('$login', '$password', '$role');";

        $mysqli->query($query);
        $mysqli->close();
    }

}





header("location: ../admin.php");

?>



