<?php
session_start();

$id=$_SESSION["sessionId"];
$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');
$sql = "select * from message where send_id='$id' order by date_time desc";
$result = mysqli_query($connect,$sql) or die ('Error querying database1');
while( $data = mysqli_fetch_array($result)){
    for($i=0;$i<=3;$i++){
        echo $data[$i];
        echo " ";
    }
    echo "<br />\n"; 
}
?>