<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>


    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>


<form action="add.php" method="post" id="myForm">
    <input  type="text" name="myname" required />
    <input  type="text" name="price"  required />
    <input type="submit" value="Dodaj"  name="submit" />
</form>


<br />

<table>
<tr>
    <td>Id</td> <td>Nazwa</td> <td>Cena</td><td></td><td></td>
</tr>
<?php

$db_name = "myDB";

mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db($db_name) or die("Cannot connect do myDB");





$query = mysql_query("select * from food");
while($row = mysql_fetch_array($query))
{
    echo "<tr>";
    echo "<td>". $row['id']. "<td>". $row['myname'] ."<td>". $row['price'];
    echo "<td>";
    echo "<form method='post' action='delete.php'>";
    echo "<input type='hidden' name='id' value='{$row['id']}' '>";
    echo "<input type='submit' value='delete'>";
    echo "</form>";
    echo "</td>";

    echo "<td>";
    echo "<form method='post' action='update.php'>";
    echo "<input type='hidden' name='id' value='{$row['id']}' '>";
    echo "<input type='submit' value='update'>";
    echo "</form>";
    echo "</td>";


    echo "</tr>";
}
?>

</table>



</body>
</html>



