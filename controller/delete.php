<?php   
$form = file_get_contents("php://input");
$_POST =  json_decode($form,true);
$conn = new mysqli("localhost","root", "", "As_Js");

$id = $_POST['id'];

$sql = "DELETE FROM `student_tbl` WHERE `id` = $id";
if(mysqli_query($conn,$sql))
{
    echo json_encode(["succes" => "Deleted"]);
}





?>