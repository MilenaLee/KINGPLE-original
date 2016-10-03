<!DOCTYPE php>
<?php

session_start();
$id=$_SESSION["sessionId"];

$connect = mysqli_connect('54.65.221.83','root','1234','project') or die('Error connecting to MySQL server');

?>
<html>
<body>
<div id="content1">            
        <div class="timetable">
            <h2>나의 시간표</h2>
            <div class="timetable_content">
                <div class="timetable_header">
                    <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="date"></th>
                            <th style="width: 107px;">월</th>
                            <th style="width: 107px;">화</th>
                            <th style="width: 107px;">수</th>
                            <th style="width: 107px;">목</th>
                            <th style="width: 107px;">금</th>
                            <th style="width: 107px;">토</th>
                            <th style="width: 107px;">일</th>
                        </tr>
                    </thead>
                    </table>
                </div>

                <div class="timetable_main">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <td class="time_nav">
                                <div class="class_time" style="height: 50px; top: 400px; line-height: 50px;"><em>오전</em><span> 9시</span></div>
                                <div class="class_time" style="height: 50px; top: 450px; line-height: 50px;"><em></em><span> 10시</span></div>
                                <div class="class_time" style="height: 50px; top: 500px; line-height: 50px;"><em></em><span> 11시</span></div>
                                <div class="class_time" style="height: 50px; top: 550px; line-height: 50px;"><em>오후</em><span> 12시</span></div>
                                <div class="class_time" style="height: 50px; top: 600px; line-height: 50px;"><em></em><span> 1시</span></div>
                                <div class="class_time" style="height: 50px; top: 650px; line-height: 50px;"><em></em><span> 2시</span></div>
                                <div class="class_time" style="height: 50px; top: 700px; line-height: 50px;"><em></em><span> 3시</span></div>
                                <div class="class_time" style="height: 50px; top: 750px; line-height: 50px;"><em></em><span> 4시</span></div>
                                <div class="class_time" style="height: 50px; top: 800px; line-height: 50px;"><em></em><span> 5시</span></div>
                                <div class="class_time" style="height: 50px; top: 850px; line-height: 50px;"><em></em><span> 6시</span></div>
                                <div class="class_time" style="height: 50px; top: 900px; line-height: 50px;"><em></em><span> 7시</span></div>        
                                <div class="class_time" style="height: 50px; top: 950px; line-height: 50px;"><em></em><span> 8시</span></div>
                                <div class="class_time" style="height: 50px; top: 1000px; line-height: 50px;"><em></em><span> 9시</span></div>
                                <div class="class_time" style="height: 50px; top: 1050px; line-height: 50px;"><em></em><span> 10시</span></div>
                            </td>
                            <?php 
                            
                            $days = 1;
                            for($days=1;$days<8;$days++)
                            {
                            	$sql = "select * from projectTime where num='$projectNum' and days='$days' order by startTime";
								$result = mysqli_query($connect,$sql) or die ('Error querying database1'); ?>
								<td class="_week" colindex="<?=$days?>">
									<?php 
								    while($row = mysqli_fetch_array($result)) { 
                                    $top1=$row['startTime']/2 - 50;
                                    ?>
									<div style="height: 50px; top:<?=$top1?>;">
										<?php 

                                        $hour = floor($row['startTime']/100);

                                        $minute = $row['startTime'] - $hour*100;
                                        if($minute == 0)
                                        {
                                            $minute = '00';
                                        }

                                              echo $row['projectName'];
                                              echo " [ ";
                                              echo $hour;
                                              echo ' : ';
                                              echo $minute;
                                              echo " ~ ";
                                              $hour = floor($row['endTime']/100);
                                              $minute = $row['endTime'] - $hour*100;
                                              if($minute == 0)
                                              {
                                                $minute = '00';
                                              }
                                              echo $hour;
                                              echo ' : ';
                                              echo $minute;
                                              echo " ] ";
                                        ?>
									</div> 
								<?php 
								} ?>

								</td>

							<?php
                            }
                            ?>                       
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>