<?php
	session_start();
	
	$memberId = $_GET[memberId];
	
	$dbid = "root";
	$dbpass = "1234";
	$dbname ="project";
	$dbhost = "54.65.221.83";
	
	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);

	if(!$memberId)
	{
		echo "아이디를 입력해주세요.";
	}
	else
	{
		//$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');
		//mysql_select_db('project',$connect); 

		$sql = "select * from test where id='$memberId'";
		$result = mysql_query($sql) or die ('Error querying database');
		$num_record = mysql_num_rows($result);

		
			
		if(!$num_record)
		{
				echo '아이디가 존재하지 않습니다.';
				echo '<button type="button" onclick="window.close();">확인</button>';
				echo '
				<script language="javascript">
				opener.document.projectadd_form.memberId.value = "";
			</script>';
		}

		else
		{
			$memberName = "SELECT name FROM test WHERE id='$memberId'";
			$memberName = mysql_query($memberName);
			$memberName = mysql_result($memberName, 0);

			if($memberId == $_SESSION["sessionId"])
			{
				echo "본인은 추가할 수 없습니다.";
				echo '<button type="button" onclick="window.close();">확인</button>';
			}	
			else
			{
				echo $memberName;
				echo "님이 맞습니까?";
				echo '<button type = "button" onclick="opener.append(1); window.close();"> 확인</button>';
				echo '<button type = "button" onclick="window.close();"> 취소</button>';
			}
			
			/*echo 
				'<script language="javascript">
				opener.append(1); </script>';*/
		}
			
		mysql_close($sqlConn);		
		echo '</br>';
	}	
		
?>