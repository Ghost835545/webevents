<?php
ob_start();
@session_start();



global $year;

if (isset($_SESSION['imageS'])) {
    $imageS = $_SESSION['imageS'];
    if ($imageS == '') {
        unset($imageS);
    }
}

if (isset($_SESSION['imageB'])) {
    $imageB = $_SESSION['imageB'];
    if ($imageB == '') {
        unset($imageB);
    }
}
if (isset($_POST['title'])) {
    $titleEvent = $_POST['title'];
    if ($titleEvent == '') {
        unset($titleEvent);
    }
}
if (isset($_POST['textEvent'])) {
    $textE = $_POST['textEvent'];
    if ($textE == '') {
        unset($textE);
    }
}
if (isset($_POST['source'])) {
    $source = $_POST['source'];
    if ($source == '') {
        unset($source);
    }
}
if (isset($_POST['country'])) {
    $country = $_POST['country'];
    if ($country == '') {
        unset($source);
    }
}
if (isset($_POST['region'])) {
    $region = $_POST['region'];
    if ($region == '') {
        unset($region);
    }
}
if (isset($_POST['punkt'])) {
    $punkt = $_POST['punkt'];
    if ($punkt == '') {
        unset($punkt);
    }
}
if (isset($_POST['dateEvent'])) {
    $dateE = $_POST['dateEvent'];
    if ($dateE == '') {
        unset($dateE);
    }
}

if (empty($imageS) | empty($titleEvent) | empty($textE) | empty($source) | empty($dateE)| empty($country) | empty($region) | empty($punkt)) {
    exit ("Вы ввели не всю информацию,заполните все поля!");

}
$imageS = stripslashes($imageS);
$imageS = htmlspecialchars($imageS);
$imageB = stripslashes($imageB);
$imageB = htmlspecialchars($imageB);
$titleEvent = stripslashes($titleEvent);
$titleEvent = htmlspecialchars($titleEvent);
$textE = stripslashes($textE);
$textE = htmlspecialchars($textE);
$source = stripcslashes($source);
$source = htmlspecialchars($source);
$country = stripcslashes($country);
$country = htmlspecialchars($country);
$region = stripcslashes($region);
$region = htmlspecialchars($region);
$punkt = stripcslashes($punkt);
$punkt = htmlspecialchars($punkt);
$dateE = stripcslashes($dateE);
$dateE = htmlspecialchars($dateE);
$timestamp = strtotime($dateE);
$year = date('Y', $timestamp);
//удаляем лишние пробелы
$imageS = trim($imageS);
$imageB = trim($imageB);
$titleEvent = trim($titleEvent);
$textE = trim($textE);
$source = trim($source);
$year = trim($year);
$dateE = trim($dateE);
$source = trim($source);
$year = trim($year);
$dateE = trim($dateE);
$country=trim($country);
$region=trim($region);
$punkt=trim($punkt);
// подключаемся к базе
require '../vendor/autoload.php';
include("query.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
$collection = $client->webevents->events;

unset($_SESSION['imageB']);
unset ($_SESSION['imageS']);

if ($collection->insertOne([
    'title' => $titleEvent,
    'imageS' => $imageS,
    'imageB' => $imageB,
    'content' => $textE,
    'dateEvent' => $dateE,
    'source' => $source,
    'country'=>$country,
    'region'=>$region,
    'punkt'=>$punkt])->isAcknowledged()) {
    echo "Вы успешно добавили информацию!";

} else {
    echo "Ошибка! Информация не добавлена.";
}
?>
