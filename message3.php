<?php
session_start();
//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
$id = $_SESSION["sessionId"];
?>

<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>킹플 쪽지</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>
    
</head>

<!--
    <frameset cols="20%,*">
    <frame src="message_form.html" name="left">
    <frame name="right">
    <frameset rows="100,*">
        <frame>
    </frameset>
</frameset>
-->

<!-- 여기서 부터는 frameset말고 다른 방법도 시도하는것입니다. by 면-->
<body>
    <header>
    <form method ="get" action="logout.php">
        <a href="main.html"><h1>KINGPLE</h1></a>
        <nav>
            <p>
                <?php
                echo $_SESSION["sessionName"];
                ?>
                님 환영합니다</p>
                <button type="button" onclick="location='message3.php'">쪽지</button>
                <button type="button" onclick="location='mypage.html'">마이페이지</button>
                <button type="button" onclick="location='logout.php'">로그아웃</button>
            </nav>

        </form>
    </header>
 
    <div id="msgMenu">
        <ul>
            <li id="rcvMsg"><a href="message_receive.html" target="content">받은 쪽지</a></li>
            <li id="sendMsg"><a href="message_send.html" target="content">보낸 쪽지</a></li>
            <li id="newMsg"><a href="message_write.html" target="content">쪽지 보내기</a></li>
        </ul>
    </div>

    <div id="content">
        <iframe src="message_receive.html" width="1200" height="800" name="content" frameborder="0"></iframe>
    </div >

    <footer>
        <p>ⓒ Team-Kingple</p>
    </footer>

</body>

</html>