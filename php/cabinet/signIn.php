<Html>
<Body>
<head
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../../javascript/indexScripts.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (($login !== '* Ваш Логин') and ($password == '* Ваш Пароль')) {
    exit ($error = "Пароль: пусто!");
} else
    if (($login == '* Ваш Логин') and ($password !== '* Ваш Пароль')) {
        exit ($error = "Логин: пусто!");
    } else
        if (($login == '* Ваш Логин') and ($password == '* Ваш Пароль')) {
            exit ($error = "Логин и Пароль: пусто!");
        }

//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);
// подключаемся к базе
require '../../vendor/autoload.php';
include("../query.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь


$collection = $client->webevents->users;


$criteria = array('login' => $_POST['login'],
    'password' => $_POST['password']);

//$regex=new MongoRegex("$nex:'fo);

$cursor = $collection->find($criteria);
$count = 0;
foreach ($cursor as $row) {
    $count++;
}
echo $count;
$cursor = $collection->find($criteria);
//print_r($cursor);
if ($count>0) {
    foreach ($cursor as $row) {
        //если существует, то сверяем пароли
        //if (($row['password'] == $password) && ($row['login'] == $login)) {
            //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
            ob_start();
            @session_start();
            $_SESSION['login'] = $row['login'];
            //$_SESSION['id'] = $row['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользовател
            //$_POST=$_SESSION['login'];
            //$_POST=$_SESSION['id'];
            /*echo '<form action="../../createEvents.php" method="post">';
            echo '</form>';*/
            echo '<script type="text/javascript">', 'window.location.href = "../../createEvents.php";', '</script>';

        //} else {
            //если пароли не сошлись

            //exit ("Неверный login или пароль!");
        //}
    }
} else {
   echo "Неверный логин или пароль!";
}
?>
</Body>
</Html>
