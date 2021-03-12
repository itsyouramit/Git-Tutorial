<?php
session_start();
include "db_connection.php";

$id = $_GET["id"];
$q1 = "DELETE FROM employee_table WHERE id='$id'";
$result = mysqli_query($conn,$q1);
header("location:all_emp.php");

?>



