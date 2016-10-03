<?php
//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
mysql_connect("54.65.221.83", "root", "1234") or die (mysql_error());
mysql_select_db("project");

//게시판 목록보기에 필요한 각종 변수 초기값을 설정합니다.
$tablename="message"; //테이블 이름
$page = isset($_GET['page']) && $_GET['page'] && is_numeric($_GET['page']) ? $_GET['page'] : 1;  //페이지 번호가 없으면 1
$list_num = 10; //한 페이지에 보여줄 목록 갯수
$page_num = 10; //한 화면에 보여줄 페이지 링크(묶음) 갯수
$offset = $list_num*($page-1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글의 번호)

//전체 글 수를 구합니다. (쿼리문을 사용하여 결과를 배열로 저장하는 일반적인 방법)
$query="select count(*) from $tablename"; // SQL 쿼리문을 문자열 변수에 일단 저장하고
$result=mysql_query($query) or die (mysql_error()); // 위의 쿼리문을 실제로 실행하여 결과를 result에 저장한 다음
$row=mysql_fetch_row($result); //위 결과 값을 하나하나 배열로 저장합니다.
$total_no=$row[0]; //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다.

//전체 페이지 수와 현재 글 번호를 구합니다.
$total_page=ceil($total_no/$list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
$cur_num=$total_no - $list_num*($page-1); //현재 글번호

//bbs테이블에서 목록을 가져옵니다. (위의 쿼리문 사용예와 비슷합니다.)
$query="select * from $tablename order by date_time desc limit $offset, $list_num"; // SQL 쿼리문
$result=mysql_query($query) or die (mysql_error()); // 쿼리문을 실행 결과
//쿼리 결과를 하나씩 불러와 실제 HTML에 나타내는 것은 HTML 문 중간에 삽입합니다.

?>

<html>
<head>
<meta http-equiv=content-type content=text/html; charset=euc-kr>
<title>글목록보기</title>
<STYLE TYPE=text/css>
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option,pre,blockquote {font-family:굴림;font-size:9pt;color:#555555;}
A:link    {color:black;text-decoration:none;}
A:visited {color:black;text-decoration:none;}
A:active  {color:black;text-decoration:none;}
A:hover  {color:gray;text-decoration:none;}
</STYLE>
</head>
<body background=./images/body_bg.gif>

<table border=1 cellspacing=0 width=680 bordercolordark=white bordercolorlight=#999999>
    <tr>
        <td width=80 bgcolor=#CCCCCC>
            <p align=center>send_id</p>
        </td>
        <td bgcolor=#CCCCCC width=490>
            <p align=center>content</p>
        </td>
        <td width=100 bgcolor=#CCCCCC>
            <p align=center>date</p>
        </td>
    </tr>

<?php
while ($array=mysql_fetch_array($result)) {

        $date=date("Y/m/d", strtotime($array['date_time'])); //글쓴시각을 Y/m/d 형식에 맞게 문자열로 바꿉니다.

        echo '<tr><td width=80><p align=center>';
        echo  $array['send_id'];
        echo '</p></td>';
        echo '<td width=490><p>';
        echo $array['content'];
        echo '</p></td><td width=100><p align=center>';
        echo $date;
        echo '</p></td>';

        $cur_num --;

}
?>
    <tr>
        <td width=100% colspan=5>

<?php
//여기서부터 각종 페이지 링크
//먼저, 한 화면에 보이는 블록($page_num 기본값 이상일 때 블록으로 나뉘어짐)
$total_block=ceil($total_page/$page_num);
$block=ceil($page/$page_num); //현재 블록

$first=($block-1)*$page_num; // 페이지 블록이 시작하는 첫 페이지
$last=$block*$page_num; //페이지 블록의 끝 페이지

if($block >= $total_block) {
        $last=$total_page;
}

echo "
                        <p align=center>";
//[처음][*개앞]
if($block > 1) {
        $prev=$first-1;
        echo "<a href='list.php?page=1'>[처음]</a>&nbsp; ";
        echo "<a href='list.php?page=$prev'>[$page_num 개 앞]</a>";
}

//[이전]
if($page > 1) {
        $go_page=$page-1;
        echo "  <a href='list.php?page=$go_page'>[이전]</a>&nbsp; ";
}

//페이지 링크
for ($page_link=$first+1;$page_link<=$last;$page_link++) {
        if($page_link==$page) {
                echo "<font color=green><b>$page_link</b></font>";
        }
        else {
                echo "<a href='list.php?page=$page_link'>[$page_link]</a>";
        }
}

//[다음]
if($total_page > $page) {
        $go_page=$page+1;
        echo "&nbsp;<a href='list.php?page=$go_page'>[다음]</a>";
}

//[*개뒤][마지막]
if($block < $total_block) {
        $next=$last+1;
        echo "<a href='list.php?page=$next'>[$page_num 개 뒤]</a>&nbsp;";
        echo "<a href='list.php?page=$total_page'>[마지막]</a></p>";
}

?>
        </td>
    </tr>
    </table>
</body>
</html>
