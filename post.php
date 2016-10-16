 <link href="css/style.css" rel="stylesheet">
   
       <style>
        body {
            background-image: url(images/f1.jpg);
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.7);
            background-blend-mode: multiply;
            
        }
           a:hover{text-decoration: underline}
       
       
    </style>
<body>

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
 
 
$date=date("Y-m-d"); // число.месяц.год 
 
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
"<h1>ENTERED DATA IS INCORRECT! <br><a 
href='javascript:history.back(1)'>BACK TO FORM.</a> </h1>"; 
 
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
 

 
<h1>YOUR MESSAGE SEND SUCCESSFULLY!<br> WAIT A SECOND</h1>";  
exit; 
 
 } 
 
?>

</body>