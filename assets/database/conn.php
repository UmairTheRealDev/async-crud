<?php  
$conn = new mysqli("localhost","root", "", "jscrud");
if ($conn->connect_error) 
{
    die("Not Connected" . $conn->connect_error);
}
?>