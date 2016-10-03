<!DOCTYPE php>
<?php
session_start();

$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');
$commentNum = $_POST['commentNum'];
$projectNum = $_POST['projectNum'];
$id = $_SESSION['sessionId'];
$cmt=$_POST['btn_type'];
if($cmt==1){
	$sql1="select id from comment where commentNum='$commentNum'";
	$result=mysqli_query($connect, $sql1);
	$del=mysqli_fetch_array($result);

	if($id==$del['id']){
		$sql2="delete from comment where commentNum='$commentNum'";
		mysqli_query($connect, $sql2) or die('Error querying database112244444444');	
		echo " <script> 
	            window.alert('삭제되었습니다.'); 
	            </script>"; 
	}
	else{
		echo " <script> 
	            window.alert('본인의 댓글만 삭제할 수 있습니다.'); 
	            location.href='project.html?id=$projectNum';
	            </script>"; 
	}

	mysqli_close($connect);

	}

else if($cmt==2){
	
	$sql1="select id from comment where commentNum='$commentNum'";
	$result=mysqli_query($connect, $sql1);
	$del=mysqli_fetch_array($result);

	if($id==$del['id']){
		echo "<script>
		   window.open('comment_edit.html?commentNum=$commentNum&projectNum=$commentNum', '댓글 수정', 'width = 600, height = 400');
		   location.href='project.html?id=$projectNum';
		   </script>";
	}
	else{
		echo " <script> 
	            window.alert('본인의 댓글만 수정할 수 있습니다.');
	            location.href='project.html?id=$projectNum'; 
	            </script>"; 
	}

	

		// <a href="" onClick = "window.open(this.href, 'popupName', 'width = 600 height = 400'); return false"></a> 

}

?>
