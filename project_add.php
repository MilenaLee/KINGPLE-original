<?php
session_start();
if(!isset($_SESSION["sessionName"]))
    {
        echo '<script>window.alert("로그인이 필요합니다");</script>';
        echo("<script>location.href='login.html';</script>");
        exit;
    }

$projectName = $_POST[projectName];
$teamLeader = $_SESSION["sessionId"]; 
$teamMember[0] = $teamLeader;
$teamMember[1] = $_POST[memberId1]; 
$teamMember[2] = $_POST[memberId2]; 
$teamMember[3] = $_POST[memberId3]; 
$teamMember[4] = $_POST[memberId4];
$teamMember[5] = $_POST[memberId5]; 
$teamMember[6] = $_POST[memberId6]; 
$teamMember[7] = $_POST[memberId7];
$teamMember[8] = $_POST[memberId8];  
$teamMember[9] = $_POST[memberId9];
$dayStart = date("Y-m-d", strtotime($_POST[period]));
$dayEnd = date("Y-m-d", strtotime($_POST[period2]));


$sStartTime = strtotime($_POST[period]);
$sEndTime = strtotime($_POST[period2]);


$connect = mysqli_connect('54.65.221.83','root','1234', 'project') or die('Error connecting to MySQL server');
$sql1="select distinct num from projectTime order by num desc limit 1";
$result= mysqli_query($connect,$sql1) or die ('Error querying database555');
$row=mysqli_fetch_array($result);
$num= $row['num'] +1;


if($sStartTime > $sEndTime){
	echo "<script> 
          window.alert('시작날짜는 끝나는 날짜보다 이전이어야 합니다.'); 
          history.go(-1); 
          </script>"; 
}
else
{	
	$sql = "insert into projectAdd(num,projectName, teamLeader, teamMember1, teamMember2, teamMember3, teamMember4, teamMember5, teamMember6, teamMember7, teamMember8, teamMember9, dayStart, dayEnd)"."values('$num','$projectName', '$teamLeader','$teamMember[1]','$teamMember[2]', '$teamMember[3]', '$teamMember[4]', '$teamMember[5]', '$teamMember[6]', '$teamMember[7]','$teamMember[8]', '$teamMember[9]', '$dayStart', '$dayEnd')"; 
	$result = mysqli_query($connect, $sql) or die('Error querying database');
	//mysql_query($sql, $connect); 
	mysqli_close($connect); 
	echo "<script> 
	          window.alert('프로젝트가 추가되었습니다.'); 
	          
	          </script>"; 
	// echo("<script>location.href='main.html';</script>");
	// 아래로 이동시킴          
}	
//단체공강찾기



		for($j=1;$j<=7;$j++)
		{
			
			$sql="select days, startTime, endTime from timetable where (id='$teamMember[0]' or id='$teamMember[1]' or id='$teamMember[2]' or id='$teamMember[3]' or id='$teamMember[4]' or id='$teamMember[5]' or id='$teamMember[6]' or id='$teamMember[7]' or id='$teamMember[8]' or id='$teamMember[9]') and days='$j' order by startTime";
			$connect = mysqli_connect('54.65.221.83','root','1234', 'project') or die('Error connecting to MySQL server');
			$result= mysqli_query($connect,$sql) or die ('Error querying database5');
			$union[0][0] = "";
			$a=0;
			while($row= mysqli_fetch_array($result)){
				if($union[$a][0]==''){
					$union[$a][0]=$j;
					$union[$a][1]=$row['startTime'];
					$union[$a][2]=$row['endTime'];
					
				}
				else{
					if($union[$a][2]>=$row['startTime']){//ex)900~1200 & 1000~1300
							if($union[$a][2]<=$row['endTime'])
								$union[$a][2]=$row['endTime'];
					}
					else{//ex)900~1200 & 1300~1400
						$a++;
						$union[$a][0]=$j;
						$union[$a][1]=$row['startTime'];
						$union[$a][2]=$row['endTime'];
					}
				}
			}
		
		$empty[0][0] = "";
		$b=0;
		for($i=0;$i<=$a;$i++)
		{
			if($empty[0][0]=='')
			{
				if($union[$i][1]==900){
					$empty[$b][0]=$j;
					$empty[$b][1]=$union[$i][2];
				}
				else{
					$empty[$b][0]=$j;
					$empty[$b][1]=900;
				}
			}

			else
			{				
				$empty[$b][0]=$j;
				$empty[$b][2]=$union[$i][1];
				$empty[$b+1][1]=$union[$i][2];
				
				$sql2="insert into projectTime(num, projectName, days, startTime, endTime)"."values('$num', '$projectName', '{$empty[$b][0]}','{$empty[$b][1]}','{$empty[$b][2]}')";
				mysqli_query($connect, $sql2) or die('Error querying database4');
				$b++;
			}
		}
		
		if($empty[$b][1]<2100)
		{	
			$empty[$b][2]=2100;
			$empty[$b][0]=$j;
			$sql2="insert into projectTime(num, projectName, days, startTime, endTime)"."values('$num', '$projectName','{$empty[$b][0]}','{$empty[$b][1]}','{$empty[$b][2]}')";
			mysqli_query($connect, $sql2) or die('Error querying database6');
		}
}

//프로젝트 수락 메시지 보내기

$send_id = $teamLeader;
$date_time = date("Y-m-d H:i:s", mktime(date("H")+9)); 
$checking = 0;
$send_dlt = 0; 
$rcv_dlt = 0; 
	
	for ($i = 1; $i <= 9; $i++){
		if($teamMember[$i]!==""){
			$rcv_id = $teamMember[$i];
			$content = "$send_id"."님께서 $projectName 프로젝트에 "."$rcv_id"."님을 추가하였습니다.";
		
			$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');
			//mysql_select_db('project',$connect); 

			$sql = "select * from member where id='$rcv_id'";
			$result = mysqli_query($connect, $sql) or die ('Error querying database1');
			$num_record = mysqli_num_rows($result);

			if($num_record){
				$sql2 = "insert into message(send_id,rcv_id,content,date_time,checking,send_dlt,rcv_dlt)"."values('$send_id','$rcv_id','$content','$date_time','$checking','$send_dlt','$rcv_dlt')";
				mysqli_query($connect, $sql2) or die(mysqli_error($connect));
			}
		}
		else{
			break;
		}
	}

	mysqli_close($connect); //message.php에서 따온 것에 내가 추가
	echo("<script>location.href='main.html';</script>");

	
?> 
