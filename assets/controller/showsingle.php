<?php require_once '../database/conn.php'; ?>

<?php

$form = file_get_contents("php://input");
$_POST = json_decode($form, true);

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $sql = "SELECT * FROM  `st_data` WHERE `id` = {$id}";
    $result = $conn->query($sql);
    $res = $result->fetch_assoc();
    echo json_encode($res);
}