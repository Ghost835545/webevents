<htm>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="javacript/sript.js"></script>
</head>
<?php
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
         if (($login !=='* Ваш Логин') and ($password=='* Ваш Пароль'))
         {
             exit ($error="Пароль: пусто!");
         }
         else
             if (($login=='* Ваш Логин') and ($password!=='* Ваш Пароль'))
             {
                 exit ($error="Логин: пусто!");
             }
             else
                if (($login=='* Ваш Логин') and ($password=='* Ваш Пароль'))
                {
                    exit ($error="Логин и Пароль: пусто!");
                }


    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
 // подключаемся к базе
    include ("../query.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
 // проверка на существование пользователя с таким же логином
    $result = mysqli_query($dbconnect,"SELECT id FROM users WHERE login='$login'");
    $myrow = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. </br>Введите другой логин.");
    }
 // если такого нет, то сохраняем данные
    $result2 = mysqli_query ($dbconnect,"INSERT INTO users (login,password) VALUES('$login','$password')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo $final= "Вы успешно зарегистрированы!";
    }
 else {
   echo "Ошибка! Вы не зарегистрированы.";
    }
 ?>
</htm>
