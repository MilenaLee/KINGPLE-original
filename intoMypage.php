<?php

	//세션을 사용하기 위해 선언하는 부분
	session_start();

	$dbid = "root";
	$dbpass = "1234";
	$dbname ="project";
	$dbhost = "54.65.221.83";
	
	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);
    
    $id = $_SESSION["sessionId"];

	$pass = $_POST['userPassword']; //사용자가 입력한 비밀번호

	//아이디를 바탕으로 그 아이디가 가진 곳의 비밀번호를 가져온다
	$getPASS = "SELECT password FROM test WHERE id='$id'";
	$getPASS = mysql_query($getPASS);
	$getPASS = mysql_result($getPASS, 0);

		
	//데이터베이스에서 가져온 비밀번호가 입력받은 비밀번호와 같다면,
	if($getPASS == $pass) {
		
		echo("<script>location.href='mypage.html';</script>"); 
	
		return 0;
	}
	else {
		echo " <script> 
           window.alert('비밀번호가 일치하지 않습니다.'); 
           history.go(-1) 
           </script>"; 
		
		return 1;
	}
	
	
	
?>