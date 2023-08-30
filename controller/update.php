<?php 
$form = file_get_contents("php://input");
$_POST =  json_decode($form,true);
$conn = new mysqli("localhost","root", "", "As_Js");
if($_POST['Submit'])
{
    $id = $_POST['id'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    if(empty($name))
    {
        echo json_encode(['nameerror' => "Please Enter Name..."]);
    }
    elseif(empty($email))
    {
        echo json_encode(['emailerror' => "Please Enter Email..."]);
    }
    else
    {
        $sql = "UPDATE `student_tbl` SET `name`='$name',`email`='$email' WHERE `id` = $id";

        if(mysqli_query($conn,$sql))
        {
            echo json_encode(['success' => "User  Edited"]);
        }
       


    }



}
