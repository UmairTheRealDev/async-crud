<?php 
$form = file_get_contents("php://input");
$_POST =  json_decode($form,true);
$conn = new mysqli("localhost","root", "", "As_Js");
if($_POST['submit'])
{
    $id = $_POST['id'];
}

$sql = "SELECT * FROM `student_tbl` where `id` = $id";
$result = mysqli_query($conn,$sql);
$res = $result->fetch_assoc();

echo json_encode($res);
