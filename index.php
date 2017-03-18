<?php
    session_start();

    if (isset($_SESSION['isLogged']))
        header("location: crud.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>


    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>


<form action="login/login.php" method="post" id="myForm">
    Login:    <br /><input  type="text" name="login" required /><br />
    Password: <br /><input  type="password" name="password"  required />
    <br /><br />    <input type="submit" value="Zaloguj"  name="submit" />
</form>


</body>
</html>



