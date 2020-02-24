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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Монитор событий в Охотском море</title>
    <link href="css/list_news.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/tabs_list.css"/>
    <script src="javascript/save_user.js"></script>
    <script src="javascript/indexScripts.js"></script>
    <script src="javascript/signIn.js"></script>
    <script src="library/jquery-3.3.1.js"></script>
    <script src="javascript/div.js"></script>

</head>
<body>

<div id="wrapper">
    <h4 id="title">События</h4>
    <div id="menu">
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
                    <li><a href="createEvents.php">Добавление</a></li>
                    <li><a href="index.php">На главную</a></li>
            </ul>
    </div>
    <div id="content">
        <div class="news">
            <div class="tabs_block">
                <?php
                require 'vendor/autoload.php';
                include("php/query.php");
                $image = '';
                $collection = $client->webevents->events;
                $filter = array();
                $options = array(
                    "sort" => array('dateEvent' => -1),
                );
                $events = $collection->find($filter, $options);
                foreach ($events as $row) {
                    echo '<div class="box visible">';
                    echo '<table width="780">';
                    echo '<form action="page.php" method="post">';
                    echo '<tr><td rowspan=3><img src="' .$row['imageS'] .'"></td><td>' . $row['title'] . '</td></tr>';
                    echo '<tr><td colspan="2" >"' . substr($row['content'], 0, 100) . '"...</td></tr>';
                    echo '<tr><td >' . date('d.m.Y', strtotime($row['dateEvent'])) . '</td> </tr>';
                    echo '</table>';

                    echo '<input type=hidden name=source value="' . $row['source'] . '">';
                    echo '<input type=hidden name=title value="' . $row['title'] . '">';
                    echo '<p align="left">';
                    echo '<input type="submit" value="Подробнее">';
                    echo '</form>';


                    echo '<form method="get">';
                    echo '<input type=hidden name=dateEvent value="' . $row['dateEvent'] . '">';
                    echo '<input type=hidden name=title value="' . $row['title'] . '">';
                    echo '<input type=submit value=Удалить>';
                    echo '</p>';
                    echo '</form>';

                    echo '<form  action="editevent.php" method="post">';
                    echo '<input type=hidden name=title value="' . $row['title'] . '">';
                    echo '<input type=hidden name=content value="' . $row['content'] . '">';
                    echo '<input type=hidden name=dateEvent value="' . $row['dateEvent'] . '">';
                    echo '<input type=hidden name=source value="' . $row['source'] . '">';
                    echo '<input type=hidden name=imageS value="' .$row['imageS'] . '">';
                    echo '<input type=hidden name=imageB value="' .$row['imageB'] . '">';
                    echo '<input type=hidden name=country value="' . $row['country'] . '">';
                    echo '<input type=hidden name=punkt value="' .$row['punkt'] . '">';
                    echo '<input type=hidden name=region value="' .$row['region'] . '">';
                    echo '<input type=hidden name=id value="' .$row['_id'] . '">';
                    echo '<input type="submit"  value="Изменить" >';
                    echo '</p>';
                    echo '</form>';
                    echo '</div>';

                    if (isset($_GET['dateEvent']) & isset($_GET['title'])) {
                        $delete=$collection->deleteOne(['dateEvent'=>$_GET['dateEvent'],'title'=>$_GET['title'] ]);
                        echo "<script>window.location.href='list_news.php'</script>";
                    }
                }


                ?>
            </div>
        </div>
        </section>
        <script type="text/javascript">
            function isEmail() {
                var str = "<?php echo "asdadasd";?>"

                /*var str = document.getElementById("email").value;
                var status = document.getElementById("status");
                var re = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
                if (re.test(str)) status.innerHTML = "Адрес правильный";
                else status.innerHTML = "Адрес неверный";
                if(isEmpty(str)) status.innerHTML = "Поле пустое";*/
            }

            function isEmpty(str) {
                return (str == null) || (str.length == 0);
            }
        </script>

    </div>
    <div id="fade" class="black-overlay"></div>
</div>


</body>
</html>