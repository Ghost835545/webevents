<?php
session_start();

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <link href="css/editEventsStyle.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/modal-contact-form.css"/>
    <link rel="stylesheet" type="text/css" href="css/input_style.css"/>
    <script src="library/jquery-3.3.1.js"></script>
    <script src="javascript/loadImage.js"></script>
    <script src="javascript/saveEvent.js"></script>
    <script src="javascript/signIn.js"></script>
    <script src="javascript/indexScripts.js"></script>
    <script src="javascript/editEvent.js"></script>
</head>
<body>

<div id="wrapper">
    <div id="menu">
        <h4 id="title">Редактирование данных</h4>
        <?php
        require 'vendor/autoload.php';
        include("php/query.php");
        /*$collection = $client->webevents->events;
        $filter = array('$and' => array(array('title' => $_POST['title']), array('content' => $_POST['content'])));
        $findid = $collection->find($filter);
        $f = 0;
        foreach ($findid as $id) {
            $f = $id['title'];
        }*/
        ?>

        <ul class="menu-main">
            <li><a href="index.php?flag=1" id="form_submit">На главную</a></li>
            <li><a href="list_news.php" id="form_submit">События</a></li>
        </ul>
    </div>
    <div id="content">
        <fieldset>
            <legend>Cобытие</legend>
            <form method="POST" id="formCreate" enctype="multipart/form-data" action="javascript:void(null);"
                  onsubmit="loadImage()">
                <input type="file" id="picture">
                <br>
                <input type="submit" value="Загрузить" name="submit">
            </form>
            <div id="output"></div>
            <form id="form1" method="post" action="javascript:void(null);">
                <?php
                echo "<p><label>Название события <input type = text name = title size = 100 id=E_title maxlength = 100 value=\"".$_POST['title']."\"></label></p>";
                echo "<p><label>Описание события <textarea name = 'content' cols = '141' rows = '40' id='text' >" . $_POST['content'] . "></textarea> </label></p>";
                echo "<p><label>Регион cобытия <input type=text name='region' id=E_title size = 110 maxlength= 200 value=\"". $_POST['region']."\"></label></p>";
                echo "<p><label>Страна события <input type=text name='country' id=E_title size = 110 maxlength= 100 value=\"". $_POST['country']."\"></label></p>";
                echo "<p><label>Ближайщий населенный пункт <input type= 'text' name='punkt' id=E_title size = '93' maxlength='200' value=\"".$_POST['punkt']."\"></label></p>";
                echo "<p><label>Дата :<input type = 'date' id=E_title name='dateEvent' value=" . $_POST['dateEvent'] . "></label></p>";
                echo "<p><label>Ссылка на источник <input type='text' id=E_title name='source' id='E_title' size='100' value=\"".$_POST['source']."\"></label></p>";
                echo "<input type = 'hidden' name='imageS' value=" . $_POST['imageS'] . ">";
                echo "<input type = 'hidden' name='imageB' value=" . $_POST['imageB'] . ">";
                echo "<input type = 'hidden' name='id' value=" . $_POST['id'] . ">";
                echo '<div align="center"><p><input type = "submit" name = "button" value = "Изменить данные" onclick="choiceOf()"></p></div>';
                ?>
            </form>

    </div>

</div>
<script>
    function choiceOf() {
        if (confirm("Вы действительно хотите изменить данные?")) {
            editEvent()
            //location.reload();

        }
    }
</script>

</div>
</body>
</html>

