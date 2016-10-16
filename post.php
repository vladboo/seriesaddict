<? 
// ----------------------------конфигурация-------------------------- // 
$connection = mysql_connect("localhost", "sa1", "sa1");
$db = mysql_select_db("mybd");
mysql_query(" SET NAMES 'utf8' "); // mysql_set_charset("utf8");

if(!$connection || !$db)
{
    exit(mysql_error());
}


$adminemail="vladborodich@yandex.ru";  // e-mail админа 
 
 
$date=date("d.m.y"); // число.месяц.год 
 
$time=date("H:i:s"); // часы:минуты:секунды 
 
$backurl="feedback.html";  // На какую страничку переходит после отправки письма 
 
//---------------------------------------------------------------------- // 
 

 
// Принимаем данные с формы 
 
$name=$_POST['name']; 
 
$email=$_POST['email']; 
 
$msg=$_POST['message']; 
 
  
 
// Проверяем валидность e-mail 
 
if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", 
strtolower($email))) 
 
 { 
 
  echo 
"<center>ENTERED DATA IS INCORRECT! <a 
href='javascript:history.back(1)'><B>BACK TO FORM</B></a>. "; 
 
  } 
 
 else 
 
 { 
     
        
       mysql_query("INSERT INTO feedback (name, email, message, date, time)
        VALUES ('$name', '$email', '$msg', '$date', '$time')");
        mysql_close();  
      
 
 
$msg=" 
 
 
NAME: $name 
 
 
E-MAIL: $email
 
 
MESSAGE: $msg 
 
 
"; 
 
  
 
 // Отправляем письмо админу  
 
mail("$adminemail", "$date $time Message from $name", "$msg"); 
 
  
 
 
// Выводим сообщение пользователю 
 
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 6000); 
//--></script> 
 

 
<p><center>YOUR MESSAGE SEND SUCCESSFULLY! WAIT A SECOND</p>";  
exit; 
 
 } 
 
?>