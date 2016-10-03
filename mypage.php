<?php

session_start();
 
$password = $_POST[userPassword]; 
$phone = $_POST[userPhone]; 
$email = $_POST[userEmail];
$age = $_POST[userAge]; 
$sex = $_POST[userType]; 
$school = $_POST[userUniv];
$major = $_POST[userMajor];  
$token = 0;

$connect = mysqli_connect('54.65.221.83','root','1234', 'project') or die('Error connecting to MySQL server');


if (!$password){
	$password = $_SESSION["sessionPassword"];
}


$sql = "update member set password = '$password', phone = '$phone', email = '$email', age = '$age', sex = '$sex', school = '$school', major = '$major' where id='$_SESSION[sessionId]'";

$result = mysqli_query($connect, $sql) or die('Error querying database');

mysqli_close($connect); 

echo "<script>alert('회원정보가 수정되었습니다. 변경된 정보는 다음 로그인 시 적용됩니다.');</script>";
echo("<script>location.href='main.html';</script>"); 


?>