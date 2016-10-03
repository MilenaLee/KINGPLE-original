<?php
//접속 db server
session_start();

$projectNum = $_POST['projectNum'];
$contents = $_POST['contents'];
$name = $_SESSION["sessionName"];
//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
 
    /*if(!$_FILES['file']['name'])
    {
        echo "<script>alert('업로드 할 파일이 입력되지 않았습니다.');";
        echo "history.back();</script>";
        exit;
    }*/
    
    if(strlen($_FILES['file']['name']) > 255)
    {
        echo "<script>alert('파일 이름이 너무 깁니다.');";
        echo "history.back();</script>";
        exit;
    }
    
    $date = date("YmdHis", time());
    $dir = "file/";
    
    $fileName = $_FILES['file']['name'];
    $upfile = $dir.$fileName;
    if(is_uploaded_file($_FILES['file']['tmp_name']))
    {
            if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
            {
                    echo "upload error";
                    exit;
            }
    }



$connect = mysqli_connect('54.65.221.83', 'root', '1234', 'project');


$sql = "insert into board(name, contents, created, fileName, projectNum)"."values('$name', '$contents', '$date','$fileName', '$projectNum')";
mysqli_query($connect, $sql) or die('Error');

mysqli_close($connect);


echo "<script>location.href='project.html?id=$projectNum';</script>";


?>
