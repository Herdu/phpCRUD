
<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 13.03.17
 * Time: 18:27
 */


function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}


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

$id = $_POST['newid'];
$name = $_POST['newmyname'];
$price = $_POST['newprice'];




if ($_SERVER['REQUEST_METHOD'] == "POST"){
    mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("myDB") or die("Cannot connect to myDB");

    console_log("UPDATE food SET myname='$name, price=$price WHERE id=$id;");
    mysql_query("UPDATE food SET myname='$name', price=$price WHERE id=$id;");

}




header("location: index.php");
?>



