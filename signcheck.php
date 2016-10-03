<?php

$id = $_POST[userId]; 
$password = $_POST[userPassword]; 
$name = $_POST[userName]; 
$phone = $_POST[userPhone]; 
$email = $_POST[userEmail];
$age = $_POST[userAge]; 
$sex = $_POST[userType]; 
$school = $_POST[userUniv];
$major = $_POST[userMajor];  
$token = 0;

$connect = mysqli_connect('54.65.221.83','root','1234', 'project') or die('Error connecting to MySQL server');

//mysql_select_db('project',$connect); 
$sql = "insert into member(id, password, name, phone, email, age, sex, school, major, token)"."values('$id','$password','$name', '$phone', '$email', '$age', '$sex', '$school','$major', '$token')"; 
mysqli_query($connect, $sql) or die('Error querying database');
//mysql_query($sql, $connect); 
mysqli_close($connect); 

echo("<script>location.href='login.html';</script>"); 

?> 


