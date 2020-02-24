<?php
ob_start();
@session_start();




/*if (!isset($_SESSION['imageS'])&!isset($_SESSION['imageS']))
{
    echo "пусто";
    echo $_POST['imageS'];
    echo $_POST['imageB'];
}*/

if (isset($_POST['title'])) { $titleEvent=$_POST['title'];} if ($titleEvent =='') { unset($titleEvent); }
if (isset($_POST['content'])) { $content = $_POST['content'];} if ($content == '') { unset($content);}
if (isset($_POST['region'])) {$region = $_POST['region'];} if ($region =='') {unset($region);}
if (isset($_POST['country'])) {$country = $_POST['country'];} if ($country =='') { unset($country);}
if (isset($_POST['punkt'])) {$punkt = $_POST['punkt'];} if  ($punkt=='') {unset($punkt);}
if (isset($_POST['dateEvent'])) { $dateE=$_POST['dateEvent'];} if ($dateE =='') { unset($dateE);}
if (isset($_POST['source'])) { $source=$_POST['source'];} if ($source =='') { unset($source);}
if (isset($_SESSION['imageS'])) { $imageS = $_SESSION['imageS'];} if (!isset($_SESSION['imageS'])) { $imageS=$_POST['imageS'];}
if (isset($_SESSION['imageB'])) { $imageB = $_SESSION['imageB'];} if (!isset($_SESSION['imageB'])) { $imageB=$_POST['imageB'];}



$imageS = stripslashes($imageS);
$imageS = htmlspecialchars($imageS);
$imageB = stripslashes($imageB);
$imageB = htmlspecialchars($imageB);
$titleEvent = stripslashes($titleEvent);
$titleEvent = htmlspecialchars($titleEvent);
$content = stripslashes($content);
$content = htmlspecialchars($content);
$source = stripcslashes($source);
$source= htmlspecialchars($source);
$dateE = stripcslashes($dateE);
$dateE= htmlspecialchars($dateE);
$timestamp = strtotime($dateE);
$year = date('Y',$timestamp);
$country = stripcslashes($country);
$country = htmlspecialchars($country);
$punkt = stripcslashes($punkt);
$punkt = htmlspecialchars($punkt);
//удаляем лишние пробелы
$imageS = trim($imageS);
$imageB = trim($imageB);
$titleEvent = trim($titleEvent);
$content = trim($content);
$source=trim($source);
$country=trim($country);
$punkt=trim($punkt);
$year = trim($year);
$dateE= trim($dateE);
// подключаемся к базе
require '../vendor/autoload.php';
include ("query.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
$collection = $client->webevents->events;

$collection = $client->webevents->events;
$filter=array('_id'=>new MongoDB\BSON\ObjectId($_POST['id']));
$update=array( '$set'=>['title'=>$titleEvent,
    'imageS'=>$imageS,
    'imageB'=>$imageB,
    'content'=>$content,
    'dateEvent'=>$dateE,
    'source'=>$source,
    'country'=>$country,
    'region'=>$region,
    'punkt'=>$punkt]);
$options=array('upsert'=>false);
$find=$collection->find($filter);

unset($_SESSION['imageB']);
unset ($_SESSION['imageS']);

if ($collection->findOneAndUpdate($filter,$update,$options))
{
   echo "Данные успешно обновлены!";


}
else {
    echo "Поизошла ошибка!!!";
}
?>