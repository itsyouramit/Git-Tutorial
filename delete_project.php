
<?php
session_start();
include "db_connection.php";
include "function.php";


$del=delete_project($conn);
header("location:all_project.php");


?>


