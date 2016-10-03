<!DOCTYPE php>
<?php
session_start();

$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');
$commentNum = $_POST['commentNum'];
$projectNum = $_POST['projectNum'];
$newcomment=$_POST['newcomment'];

$sql="update comment set comment='$newcomment' where commentNum='$commentNum'";
mysqli_query($connect, $sql) or die ('error333');

mysqli_close($connect);


echo " <script> 
    window.alert('수정되었습니다.');
    opener.location.reload();
	window.close();
    </script>"; 


?>
