<?php
	session_start();
	$id=$_SESSION["sessionId"];
	$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');

	$_SESSION['token']=0;
	$_SESSION['id']=0;
	
	$sql="update member set token='0' where id='$id'";
	$result= mysqli_query($connect,$sql) or die ('Error querying database');

	session_unset();
	session_destroy();

	echo "<script>alert('로그아웃 되었습니다');</script>";
	echo "<script>location.href='login.html'</script>";

?>