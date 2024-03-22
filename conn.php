<?php
$connection = mysqli_connect("localhost", "atdenton", "SpBeSnKe30Uc", "atdenton");
// Check connection
if (mysqli_connect_errno())
{
echo "Could not connect to database: " . mysqli_connect_error();
}//end if
return $connection;
?>