
<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 13.03.17
 * Time: 18:27
 */

    session_start();

    unset($_SESSION['isLogged']);
    unset($_SESSION['user']);
    header("location: ../index.php");

?>



