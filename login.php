<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();

	
	//데이터베이스에 접근하기 위한 부분
	$dbid = "root";
	$dbpass = "1234";
	$dbname ="project";
	$dbhost = "54.65.221.83";
	
	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);
	
	//아이디와 비밀번호의 값을 POST방식으로 받는 것
	$id = $_POST['userId'];
	$pass = $_POST['userPassword'];
	
	
	//입력받은 아이디가 존재하는지 체크하기 위해 데이터베이스에서 id를 가져옴
	$getID = "SELECT id FROM member WHERE id='$id'";
	$getID = mysql_query($getID);
	$getID = mysql_fetch_array($getID);
	
	//아이디가 있다면
	if($getID['id']) {
		//아이디를 바탕으로 그 아이디가 가진 곳의 비밀번호를 가져온다
		$getPASS = "SELECT password FROM member WHERE id='$id'";
		$getPASS = mysql_query($getPASS);
		$getPASS = mysql_result($getPASS, 0);
		
		//데이터베이스에서 가져온 비밀번호가 입력받은 비밀번호와 같다면,
		if($getPASS == $pass) {
			//64자리의 무작위 문자열을 생성한다.
			//이 64자리의 임의의 수가 바로 토큰으로 로그인 대조에 사용할 키 값.
			$key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789^/';
			for($i=0;$i<=63;$i++)
				$token .= $key[rand(0,63)];
			
			//방금 만든 토큰을 데이터베이스에 업데이트한다.
			//입력받은 아이디가 있는 위치에 업데이트.
			$updateToken = "UPDATE member SET token='$token' WHERE id='$id'";
			$updateToken = mysql_query($updateToken);
		
			//세션에 토큰 즉 키 값을 등록한다.
			$_SESSION['token'] = $token;
			$_SESSION["sessionId"] = $id;
			$_SESSION["sessionName"] = "SELECT name from member where id='$id'";
			$_SESSION["sessionName"] = mysql_query($_SESSION["sessionName"]);
			$_SESSION["sessionName"] = mysql_result($_SESSION["sessionName"], 0);

			//세션에 패스워드 등록
			$_SESSION["sessionPassword"] = "SELECT password from member where id='$id'";
			$_SESSION["sessionPassword"] = mysql_query($_SESSION["sessionPassword"]);
			$_SESSION["sessionPassword"] = mysql_result($_SESSION["sessionPassword"], 0);

			//세션에 폰번호 등록
			$_SESSION["sessionPhone"] = "SELECT phone from member where id='$id'";
			$_SESSION["sessionPhone"] = mysql_query($_SESSION["sessionPhone"]);
			$_SESSION["sessionPhone"] = mysql_result($_SESSION["sessionPhone"], 0);

			//세션에 이메일 등록
			$_SESSION["sessionEmail"] = "SELECT email from member where id='$id'";
			$_SESSION["sessionEmail"] = mysql_query($_SESSION["sessionEmail"]);
			$_SESSION["sessionEmail"] = mysql_result($_SESSION["sessionEmail"], 0);

			//세션에 나이 등록
			$_SESSION["sessionAge"] = "SELECT age from member where id='$id'";
			$_SESSION["sessionAge"] = mysql_query($_SESSION["sessionAge"]);
			$_SESSION["sessionAge"] = mysql_result($_SESSION["sessionAge"], 0);

			//세션에 학교 등록
			$_SESSION["sessionSchool"] = "SELECT school from member where id='$id'";
			$_SESSION["sessionSchool"] = mysql_query($_SESSION["sessionSchool"]);
			$_SESSION["sessionSchool"] = mysql_result($_SESSION["sessionSchool"], 0);

			//세션에 전공 등록
			$_SESSION["sessionMajor"] = "SELECT major from member where id='$id'";
			$_SESSION["sessionMajor"] = mysql_query($_SESSION["sessionMajor"]);
			$_SESSION["sessionMajor"] = mysql_result($_SESSION["sessionMajor"], 0);



			echo("<script>location.href='main.html';</script>"); 
		
			return 0;
		}
		else {
			echo " <script> 
            window.alert('입력한 비밀번호가 잘못되었습니다.'); 
            history.go(-1) 
            </script>"; 
			
			return 1;
		}
	}
	
	else {
		echo " <script> 
            window.alert('존재하지 않는 아이디나 패스워드입니다'); 
            history.go(-1) 
            </script>"; 
		
		return 1;
	}
?>