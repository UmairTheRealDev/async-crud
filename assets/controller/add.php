

<?php

$form = file_get_contents("php://input");
$_POST = json_decode($form, true);

if(isset($_POST['submit']))
{
    $name  = $_POST['name']; 
    $email = $_POST['email'];
    if(empty($name))
    {
        echo json_encode(['isemptyname' => 'plaese enter your name']);
    }
    elseif(empty($email))
    {
        echo json_encode(['isemptyemail' => 'plaese enter your Email']);
    }
    else{
        $conn = new mysqli("localhost","root", "", "jscrud");
        $sql = "INSERT INTO `st_data`(`name`, `email`) VALUES
         ('$name','$email')";

        if ($conn->query($sql)) {
            echo json_encode(['success' => 'User has been successfully added!']);
        } else {
            echo json_encode(['failed' => 'User has failed to add!']);
         }
    }
}
















?>