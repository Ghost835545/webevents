<?php
session_start();
if (!isset($_SESSION['login']))
{
    echo '<script>location.replace("index.php");</script>';
}
if ($_GET['out']==1){
    unset($_SESSION['login']);
    unset($_GET['out']);
    echo '<script>location.replace("index.php");</script>';
    foreach ($_SESSION as $as)
    {
        var_dump($as);
    }

}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <link href="css/createEventsStyle.css" type="text/css" rel="stylesheet">
    <script src="library/jquery-3.3.1.js"></script>
    <script src="javascript/loadImage.js"></script>
    <script src="javascript/saveEvent.js"></script>
</head>
<body>
<div id="wrapper">
    <div id="menu">
        <h4 id="title">Добавление события</h4>
        <div id="SignIn">
            <fieldset id="admin">
            <legend id="legend">Для администратора</legend>
        <?php
        $out=1;
        echo"<h5 id=font_admin>Вы вошли как '".$_SESSION['login']."' </h5>";
                echo'<form method=get>';
                echo '<input type=hidden name=out value="'. $out .'">';
                echo'<input type="submit" class="signIn" value="Выйти">';

                echo '</form>';
                ?>
              </fieldset>
        </div>
        <ul class="menu-main">
            <li><a href="index.php?flag=1" id="form_submit">На главную</a></li>
            <li><a href="list_news.php" id="form_submit">События</a></li>
        </ul>
    </div>
    <div id="content">
        <fieldset>
            <legend>Новое событие</legend>
            <form method="POST" id="formCreate" enctype="multipart/form-data" action="javascript:void(null);" onsubmit="loadImage()">
                <input type="file" id="picture">
                <br>
                <input type="submit" value="Загрузить" name="submit">
            </form>
            <div id="output"></div>
            <form id="form1" method="post" action="javascript:void(null);" onsubmit="saveEvent()">
                <p><label>Введите название события <input type="text" name="title" size="100" maxlength="100"></label></p>
                <p><label>Описание события <textarea name="textEvent" cols="141" rows="25" id="text"></textarea></label></p>
                <p><label>Регион cобытия <input type="text" name="region" size = "110" maxlength="100"></label></p>
                <p><label>Страна события <input type="text" name="country" size = "110" maxlength="100"></label></p>
                <p><label>Ближайщий населенный пункт <input type="text" name="punkt" size = "93" maxlength="100"></label></p>
                <p><label>Дата события <input type="date" name="dateEvent"></label></p>
                <p><label>Ссылка на источник <input type="text" name="source" size="104"></label></p>
                <div align="center"><p><input type="submit" name="button" value="Добавить" ></p></div
            </form>
        </fieldset>
    </div>

<div id="footer"></div>
</body>
</html>

