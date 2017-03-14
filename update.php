<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>



    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>


<table>
    <tr>
        <td>Id</td> <td>Nazwa</td> <td>Cena</td><td></td>
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





if ($_SERVER['REQUEST_METHOD'] == "POST"){
    mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("myDB") or die("Cannot connect to myDB");


    $id = $_POST['id'];

     $query = mysql_query("SELECT * FROM food where id={$id}");


     echo "<tr>";


    while($row = mysql_fetch_array($query))
    {
        echo "<form method='post' action='confirmUpdate.php'>";
        echo "<td>";
        echo $row['id'];
        echo "<input type='hidden' name='newid' value='{$row['id']}' '>";
        echo "</td><td>";
        echo "<input type='text' name='newmyname' value='{$row['myname']}' '>";
        echo "</td><td>";
        echo "<input type='text' name='newprice' value='{$row['price']}' '>";
        echo "</td><td>";
        echo "<input type='submit' value='zapisz'>";
        echo "</form>";
    }

}
    echo "</tr>";
    echo "</td>";
    echo "</table>";

?>



<a href="index.php"><button>Wróć</button></a>

</body>
</html>


