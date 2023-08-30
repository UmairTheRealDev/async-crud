<?php 
$conn = new mysqli("localhost","root", "", "As_Js");

$sql = "SELECT * FROM `student_tbl`";
$result = mysqli_query($conn,$sql);
$res = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($res);


?>