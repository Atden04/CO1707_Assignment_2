<?php
$connection = mysqli_connect("localhost", "root", "", "union-shop");
// Check connection
if (mysqli_connect_errno())
{
echo "Could not connect to database: " . mysqli_connect_error();
}//end if
return $connection;
?>