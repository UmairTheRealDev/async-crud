<?php require_once '../database/conn.php'; ?>
<?php 
$sql = "SELECT * FROM  `st_data`";
$result = $conn->query($sql);
$res = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($res);
