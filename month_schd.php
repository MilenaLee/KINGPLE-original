<?php
session_start();

$id = $_SESSION["sessionId"];
$startTimeHour = $_POST[time1]; 
$startTimeMinute = $_POST[time2];
$startTime=($startTimeHour*100)+$startTimeMinute; 
$endTimeHour = $_POST[time3];
$endTimeMinute = $_POST[time4];
$endTime=($endTimeHour*100)+$endTimeMinute; 
$content = $_POST[todo]; 

$date = "$_POST[year]"."-"."$_POST[month]"."-"."$_POST[day]";
$num = $_POST[num];
$projectNum = $_POST[projectNum];
	

	if($startTime>=$endTime){
	echo "<script> 
          window.alert('시작시간은 끝나는 시간보다 이른 시간이어야 합니다.'); 
          history.go(-1) 
          </script>"; 
	}
	else{
		
	$connect = mysqli_connect('54.65.221.83','root','1234', 'project') or die('Error connecting to MySQL server');

	//mysql_select_db('project',$connect); 
		$sql = "insert into monthtable(id, date, num, projectnum, startTime, endTime, content)"."values('$id', '$date', '$num', '$projectNum', '$startTime', '$endTime', '$content')"; 
		$result = mysqli_query($connect, $sql) or die('Error querying database');
	//mysql_query($sql, $connect); 
		mysqli_close($connect); 

		echo "<script>
				opener.location.reload();
				window.close();</script>";
	}

?> 