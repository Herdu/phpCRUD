
<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 13.03.17
 * Time: 18:27
 */

    session_start();
    require_once("../database/db_data.php");


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
    $login = $_POST['login'];
    $pass = $_POST['password'];

    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($mysqli->connect_errno)
    {
        echo "failed to connect to mysql: ". $mysqli->connect_error;
    }
    else
    {

        $query = "SELECT * FROM users where login = '$login'  and password='$pass'";
        $res = $mysqli->query($query);
        if (!$res)
            echo "query error";

        if ($row = $res->fetch_assoc())
        {
            //login success
            $_SESSION['user'] = $login;
            $_SESSION['isLogged'] = true;
            $_SESSION['table'] = $_SESSION['user'] . "Table";
            if ($row['role'] == 2)
            {
                $_SESSION['isAdmin'] = true;
                header("location: ../admin.php");
            }
            else
            {
                header("location: ../crud.php");
            }



        }
        else
        {
            header("location: ../index.php");
        }



        $mysqli->close();
    }










?>



