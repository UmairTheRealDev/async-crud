<?php

$form = file_get_contents("php://input");
$_POST = json_decode($form, true);

if(isset($_POST['submit'])) {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    if (empty($name)) {
        echo json_encode(['isemptyname' => 'plaese enter your name']);
    } elseif (empty($email)) {
        echo json_encode(['isemptyemail' => 'plaese enter your Email']);
    } else
    {
        $conn = new mysqli("localhost","root", "", "jscrud");
        $sql = "UPDATE `st_data` SET `name` = '$name',`email` = '$email' WHERE `id` = '$id'";
            if ($conn->query($sql))
            {
            echo json_encode(['succes'=> 'edited']);
            }
            else{
                echo json_encode(['failed'=> ' not edited']);
            }

    }
}
