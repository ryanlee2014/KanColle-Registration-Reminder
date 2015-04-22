<?php header('Content-type: application/x-javascript'); ?>
<?php 
$url = "http://www.haoyuan.info/twitter/index.php"; //获取内容
global $contents; 
$contents = file_get_contents($url); 
//如果出现中文乱码使用下面代码 
//$getcontent = iconv("gb2312", "utf-8",$contents);
?> 
<?php
$notimepart="/：【\d+\/\d+\(\S+\)\】/";//没有小时的正则表达式
$nexttime="/\d+\/\d+\(\S*曜日\)\s*\d+:\d+(?=】)/";//catch all
$li="/\d+\S\d+(?=名】)/";
$comma="/\d+(?=,)\d+/";
$ne=preg_match("/\d+\S+(?:】)\S*(?=に|以)/",$contents,$next);
$nemo=preg_match("/\d+/",$next[0],$nextmonth);
$neda=preg_match("/\d{1,2}(?=\()/",$next[0],$nextdate);
$newe=preg_match("/\S{3}曜日/",$next[0],$nextweekday);
$evti=preg_match("/<p>(?:\S+)(?=イベント)\S+(?:【)(\d+)\S\d+\S+(?:】)(?=\S+)/",$contents,$event_time);
$evti_=preg_match("/\d{1,2}(?=\/)/",$event_time[0],$event_month);
$evti_1=preg_match("/\d{1,2}(?=\()/",$event_time[0],$event_date);
$event_wee=preg_match("/\S{3}曜日/",$event_time[0],$event_weekday);
$count=preg_match($li,$contents,$pe);
$netim=preg_match($nexttime,$contents,$nval);
$ntp=preg_match($notimepart,$contents,$nowtimepart);
$_mon=preg_match("/\d{1,2}/",$nowtimepart[0],$_month);
$_da=preg_match("/\d{1,2}(?=\()/",$nowtimepart[0],$_date);
$_weekd=preg_match("/\S{3}曜日/",$nowtimepart[0],$_weekday);
$text=preg_match($part,$contents,$matches);
$mon=preg_match("/\d{1,2}/",$nval[0],$month);
$da=preg_match("/\d{1,2}(?=\()/",$nval[0],$day);
$week=preg_match("/\S{3}曜日/",$nval[0],$weekday);
$ho=preg_match("/\d+(?=:)/",$nval[0],$hour);
$min=preg_match("/\d+$/",$nval[0],$minute);
$people=$pe[0];
//活动设定
$eve=preg_match("/((春|夏|秋|冬)イベント)(\S)+(?=】)/",$contents,$event);
$eventval=$event[0];
$ye=preg_match("/(2)\d{3}/g",$eventval,$event_year);
if($event_year[0]=="")
{
	$event_yr="null";
}
else
{
	$event_yr=$event_year[0];
}
$evn=preg_match("/(\S|\s)+】/",$eventval,$event_name);
if($event_month[0]==""&&$event_date[0]==""&&$event_weekday[0]=="")
{
	$event_m="null";
	$event_d="null";
	$event_w="null";
}
else
{
	$event_m=$event_month[0];
	$event_d=$event_date[0];
	$event_w=$event_weekday[0];
}
if((int)$_month[0]>(int)$month[0])
{
$m=$_month[0];	
$h=null;
$mi=null;
$dat=$_date[0];
$w=$_weekday[0];
}
else if((int)$month[0]==(int)$_month[0])
{
	if((int)$_date[0]>(int)$day[0])
		{
			$m=$_month[0];	
			$h="null";
			$mi="null";
			$dat=$_date[0];
			$w=$_weekday[0];
		}
	else if($_date[0]==$day[0])
		{
			$m=$month[0];
			$dat=$day[0];
			$mi=$minute[0];
			$h=$hour[0];
			$w=$weekday[0];
		}

}
		/*
$arr = array ('month'=>$month[0],'date'=>$day[0],'weekday'=>$weekday[0],'hour'=>$hour[0],'minute'=>$minute[0]);
$jsonval=json_encode($arr);
$txt="kancolle={month:\"".$month[0]."\",date:\"".$day[0]."\",weekday:\"".$weekday[0]."\",hour:\"".$hour[0]."\",minute:\"".$minute[0]."\"}";
*/
//如果使用JSON则启动此段
?>
<?php
if($h!="null")
{
$h-=1;	
}
?>
<?php
echo "var month=new Number();\n";
echo "var date=new Number();\n";
echo "var weekday=new String();\n";
echo "var hour=new Number();\n";
echo "var minute=new Number();\n";
echo "var people=new String();\n";
echo "var event_year=new Number();\n";
echo "var event_name=new String();\n";
echo "var event_month=new Number();\n";
echo "var event_date=new Number();\n";
echo "var event_weekday=new String();\n";
echo "var nextmonth=new Number();\n";
echo "var nextdate=new Number();\n";
echo "var nextweekday=new String()\n";
echo "month=".$m.";\n";
echo "date=".$dat.";\n";
echo "weekday=\"".$w."\";\n";
echo "hour=".$h.";\n";
echo "minute=".$mi.";\n";
echo "people=\"".$people."\";\n";
echo "event_year=".$event_yr.";\n";
echo "event_name=\"".$event_name[0]."\";\n";
echo "event_month=".$event_m.";\n";
echo "event_date=".$event_d.";\n";
echo "event_weekday=\"".$event_w."\";\n";
echo "nextmonth=".$nextmonth[0].";\n";
echo "nextdate=".$nextdate[0].";\n";
echo "nextweekday=\"".$nextweekday[0]."\";\n";
?>
<?php
/*
$file=fopen("datelog.js","a");
echo fwrite($file,);
fclose($file);
*/
?>
<?php
$dom=new DOMDocument('1.0','UTF-8');
$filename="/xml/timetable.xml";
if(file_exists($filename))
{
$dom->load($filename);
}
else
{
	
}
?>
