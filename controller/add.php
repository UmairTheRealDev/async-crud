<?php 
$form = file_get_contents("php://input");
$_POST =  json_decode($form,true);
$conn = new mysqli("localhost","root", "", "As_Js");
if($_POST['Submit'])
{
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
        $sql = "INSERT INTO `student_tbl`( `name`, `email`) VALUES ('{$name}','{$email}')";

        if(mysqli_query($conn,$sql))
        {
            echo json_encode(['success' => "User Added"]);
        }
        else
        {
            echo json_encode(['error' => "User not  Added"]);
        }


    }



}
