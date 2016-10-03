<?php

session_start();

//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
$connect = mysqli_connect('54.65.221.83', 'root', '1234', 'project');
// Check if delete button active, start this 

 
for($i=0; $i<count($_POST['send_checkbox']); $i++)
{
  
$position = $_POST['send_checkbox'];
$num = $position[$i];

$sql = "update message set send_dlt = '1' where num = '$num'";
mysqli_query($connect, $sql);

$sql2 = "select * from message where num='$num'";
$result = mysqli_query($connect, $sql2);
$check = mysqli_fetch_array($result);

	if(($check[send_dlt] == 1) && ($check[rcv_dlt] == 1))
	{
  		$sql3="delete from message where num='$num'";
  		mysqli_query($connect, $sql3) or die('Error querying database1133'); 
	}

}

for($i=0; $i<count($_POST['rcv_checkbox']); $i++)
{
  
$position = $_POST['rcv_checkbox'];
$num = $position[$i];

$sql = "update message set rcv_dlt = '1' where num = '$num'";
mysqli_query($connect, $sql);

$sql2 = "select * from message where num='$num'";
$result = mysqli_query($connect, $sql2);
$check = mysqli_fetch_array($result);

	if(($check[send_dlt] == 1) && ($check[rcv_dlt] == 1))
	{
  		$sql3="delete from message where num='$num'";
  		mysqli_query($connect, $sql3) or die('Error querying database1133'); 
	}

}




mysqli_close($connect);
echo " <script> 
           window.alert('삭제되었습니다.'); 
           </script>"; 


echo("<script>location.href='message_receive.html';</script>");

?>