<?php
//접속 db server
session_start();

$projectNum = $_POST['projectNum'];
$boardNum = $_POST['boardNum'];
$id = $_SESSION["sessionId"]; 
$comment = $_POST['comment'];
$date = date("YmdHis", time());
$connect = mysqli_connect('54.65.221.83', 'root', '1234', 'project');
    
$sql = "insert into comment(boardNum, id, comment, created)"."values('$boardNum', '$id', '$comment', '$date')";
mysqli_query($connect, $sql) or die('Error111');

mysqli_close($connect);

echo "<script>location.href='project.html?id=$projectNum';</script>";


?>
