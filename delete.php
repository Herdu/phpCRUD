
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





if ($_SERVER['REQUEST_METHOD'] == "POST"){
    mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("myDB") or die("Cannot connect to myDB");


    $id = $_POST['id'];

     $query = mysql_query("DELETE FROM food WHERE id=$id;");

}


session_start();



header("location: index.php");
?>



