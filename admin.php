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
<div class="admin-panel">
    <h2>PANEL ADMINISTRACYJNY!</h2>
</div>

<h2>
    Witaj, <?php echo ucwords($_SESSION['user']); ?>
</h2>

<a href="login/logout.php"><button>wyloguj</button></a><br />


<div class="form-container">
    <form action="database/addUser.php" method="post" id="myForm">
        <br />
        <h2>Dodaj użytkownika</h2>
        Login: <input  type="text" name="login" required />
        <br />Hasło: <input  type="text" name="password"  required />
        <br /><input type="hidden" name="role" value="0" />
        <input type="submit" value="Dodaj"  name="submit" />
    </form>
</div>

<div class="form-container">
    <form action="database/addUser.php" method="post" id="myForm" class="alert">
        <br />
        <h2>Dodaj administratora</h2>
        Login: <input  type="text" name="login" required />
        <br />  Hasło: <input  type="text" name="password"  required />
        <br /><input type="hidden" name="role" value="2" />
        <input type="submit" value="Dodaj"  name="submit" />
    </form>
</div>



<br />
<h2>Użytkownicy:</h2>

<table class="admin-table">
<tr>
    <td>Id</td> <td>Login</td> <td>Hasło</td><td>Uprawnienia</td><td></td><td></td>
</tr>
<?php



$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($mysqli->connect_errno)
{
    echo "failed to connect to mysql: ". $mysqli->connect_error;
}

else
{


    $query = "select * from users";

    $res = $mysqli->query($query);


    while($row = $res->fetch_assoc())
    {
        if ($row['login'] == $_SESSION['user'])
        {
            echo "<tr class='special-row'>";
            echo "<td>". $row['id']. "</td><td class='alert'>". $row['login'] ."</td><td>". $row['password']."</td><td>". $row['role']."</td>";

        }

    else
        {
            echo "<tr>";
            echo "<td>". $row['id']. "</td><td>". $row['login'] ."</td><td>". $row['password']."</td><td>". $row['role']."</td>";

        }


        echo "<td>";
        if ($row['login'] != $_SESSION['user'])
        {
            echo "<form method='post' action='database/deleteUser.php'>";
            echo "<input type='hidden' name='id' value='{$row['id']}' '>";
            echo "<input type='submit' value='delete'>";
            echo "</form>";
        }

        echo "</td>";

        echo "<td>";

        if ($row['login'] != $_SESSION['user'])
        {
            echo "<form method='post' action='database/updateUser.php'>";
            echo "<input type='hidden' name='id' value='{$row['id']}' '>";
            echo "<input type='submit' value='update'>";
            echo "</form>";
        }

        echo "</td>";


        echo "</tr>";
    }

}


?>

</table>
Uprawnienia: 0-'user' 2-'admin'



</body>
</html>



