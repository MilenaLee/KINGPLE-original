<!DOCTYPE php>
<?php
session_start();
$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');


$projectNum = $_POST['projectNum'];


for($i=0; $i<count($_POST['boardnum']); $i++){
$position = $_POST['boardnum'];
$num = $position[$i];

$sql="delete from board where boardNum='$num'";
mysqli_query($connect, $sql) or die('Error querying database1122'); 

}

mysqli_close($connect);
echo " <script> 
           window.alert('삭제되었습니다.'); 
           </script>"; 


echo "<script>location.href='project.html?id=$projectNum';</script>";

?>
