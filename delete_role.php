<?php
session_start();
include "db_connection.php";

$id = $_GET["id"];
$q1 = "DELETE FROM role_table WHERE id='$id'";
$result = mysqli_query($conn,$q1);
header("location:department_role.php");

?>


