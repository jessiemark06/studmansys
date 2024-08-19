<?php
$con = mysqli_connect("localhost", "root", "");
if(!$con)
{
    die("Cannot Connect" . mysqli_error());
}
mysqli_select_db($con, "students") or die("Cannot Connect");
?>