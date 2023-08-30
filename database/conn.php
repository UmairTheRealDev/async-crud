<?php  
$conn = new mysqli("localhost","root", "", "As_Js");
if ($conn->connect_error) 
{
    die("Not Connected" . $conn->connect_error);
}
?>