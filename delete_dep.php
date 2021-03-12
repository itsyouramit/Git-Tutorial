<?php
session_start();
include "db_connection.php";

$id = $_GET["id"];
$q1 = "DELETE FROM department_table WHERE id='$id'";
$result = mysqli_query($conn,$q1);
header("location:all_department.php");

?>



