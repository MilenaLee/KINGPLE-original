<?php
	$userId = $_GET[userId];

	if(!$userId)
	{
		echo "아이디를 입력해주세요.";
	}
	else
	{
		$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');
		//mysql_select_db('project',$connect); 

		$sql = "select * from member where id='$userId'";
		$result = mysqli_query($connect, $sql) or die ('Error querying database');
		$num_record = mysqli_num_rows($result);
			if($num_record)
			{
				echo '아이디가 중복됩니다.'.'</br>';
				echo '다른 아이디를 사용하세요.';
			}
			else
			{
				echo '사용 가능한 아이디 입니다.';
			}
		mysqli_close($connect);		
		echo '</br>';
	}	
		
?>
	<html>
		<body>
			<form>
			<button type="button" onclick="window.close();">확인</button>
			</form>
		</body>
	</html>
