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



require_once("database/db_data.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>


    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
todo: zabezpieczenia, admin_panel, kazdy_uzytkownik_ma_wlasna_tabele, walidacja_pól

<h2>
    Witaj, <?php echo ucwords($_SESSION['user']); ?>
</h2>

<a href="login/logout.php"><button>wyloguj</button></a>

<form action="database/add.php" method="post" id="myForm">
    <br />
    <h2>Dodaj</h2>
    Nazwa: <input  type="text" name="myname" required />
    Cena: <input  type="text" name="price"  required />
    <input type="submit" value="Dodaj"  name="submit" />
</form>


<br />

<table>
<tr>
    <td>Id</td> <td>Nazwa</td> <td>Cena</td><td></td><td></td>
</tr>
<?php


$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($mysqli->connect_errno)
{
    echo "failed to connect to mysql: ". $mysqli->connect_error;
}

else
{
    $query = "select * from food";

    $res = $mysqli->query($query);


    while($row = $res->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>". $row['id']. "<td>". $row['myname'] ."<td>". $row['price'];
        echo "<td>";
        echo "<form method='post' action='database/delete.php'>";
        echo "<input type='hidden' name='id' value='{$row['id']}' '>";
        echo "<input type='submit' value='delete'>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        echo "<form method='post' action='database/update.php'>";
        echo "<input type='hidden' name='id' value='{$row['id']}' '>";
        echo "<input type='submit' value='update'>";
        echo "</form>";
        echo "</td>";


        echo "</tr>";
    }

}


?>

</table>



</body>
</html>



