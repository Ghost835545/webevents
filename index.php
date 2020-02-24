<?php
session_start();

if ($_GET['out']==1){
    unset($_SESSION['login']);
    unset($_GET['out']);
    echo '<script>window.location.href("index.php");</script>';
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Монитор событий в Охотском море</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/modal-contact-form.css"/>
    <link rel="stylesheet" type="text/css" href="css/tabs-style.css"/>
    <script src="javascript/save_user.js"></script>
    <script src="javascript/indexScripts.js"></script>
    <script src="javascript/signIn.js"></script>
    <script src="library/jquery-3.3.1.js"></script>
    <script src="javascript/div.js"></script>
</head>
<body>

<div id="wrapper">
    <h4 id="title">Монитор собыйтий в Охотском море</h4>
    <div id="Authorisation">
        <fieldset id="admin">
            <legend id="legend">Для администратора</legend>
            <!--<a class="registration"  onclick = "showRegistration()">Регистрация</a>-->
            <?php
            $out=1;
            if (isset($_SESSION['login'])){
                echo"<h5 id=font_admin>Вы вошли как '".$_SESSION['login']."' </h5>";
                echo'<form method=get>';
                echo '<input type=hidden name=out value="'. $out .'">';
                echo'<input type="submit" class="signIn" value="Выйти">';
                echo '</form>';
            }
            else {
                echo "<a class=signIn onclick=showSignIn()>Войти</a>";
            }
            ?>

        </fieldset>
        <div id="envelope1" class="envelope1">
            <a class="close-btn" onclick="closeSignIn()">Закрыть</a>
            <h1 class="title">Авторизация</h1>
            <form method="POST" id="formxS" action="javascript:void(null);" onsubmit="signIn()">
                <input type="text" name="login" onclick="this.value='';" onfocus="this.select()"
                       onblur="this.value=!this.value?'* Ваш Логин':this.value;" value="* Ваш Логин"
                       class="your-login"/>
                <input type="password" name="password" onclick="this.value='';" onfocus="this.select()"
                       onblur="this.value=!this.value?'* Ваш Пароль':this.value;" value="* Ваш Пароль"
                       class="password"/>
                <input type="submit" name="submit" value="Войти" class="save-user">
            </form>
            <div id="results1"></div>
        </div>
    </div>

    <div id="menu">
        <nav>
            <ul id="navigation">
                <!--<li><a href="#">О сайте</a></li>-->
            </ul>
        </nav>
    </div>
    <div id="sidebar">
        <?php
        include "php/parse.php";
        ?>
    </div>
    <div id="content">
        <section class="news">
            <div class="tabs_block">
                <?php
                require 'vendor/autoload.php';
                include("php/query.php");
                $image = '';
                $collection = $client->webevents->events;
                $filter = array();
                $options = array(
                    "sort" => array('dateEvent' => 1),
                );
                $events = $collection->find($filter, $options);
                foreach ($events as $row) {
                    echo '<div class="box visible">';
                    echo '<table width="780">';
                    echo '<form action="page.php" method="post">';
                    echo '<input type=hidden name=source value="' . $row['source'] . '">';
                    echo '<input type=hidden name=title value="' . $row['title'] . '">';
                    echo '<tr><td rowspan=3><img src="' .$row['imageS'] .'"></td><td>' . $row['title'] . '</td></tr>';
                    echo '<tr><td colspan="2" >"' . substr($row['content'], 0, 100) . '"...</td></tr>';
                    echo '<tr><td >' . date('d.m.Y', strtotime($row['dateEvent'])) . '</td> </tr>';
                    echo '</table>';

                    echo '<p align="right"><input type="submit" value="Подробнее"></p>';
                    echo '</form>';
                    //}
                    echo '</div>';
                    // }
                }
                ?>
            </div>
        </section>
        <script>
            (function (s) {
                var n;
                s(".tabs").on("click", "li:not(.active)",
                    function () {
                        //setEqualHeight($("#content,#sidebar")),
                        //setEqualHeightB($("#content,.tabs_block,#sidebar")),
                        n = s(this).parents(".tabs_block"), s(this).dmtabs(n)
                    }),
                    s.fn.dmtabs = function (n) {
                        s(this).addClass("active").siblings().removeClass("active"), n.find(".box").eq(s(this).index()).show(1, function () {
                            s(this).addClass("open_tab")
                        }).siblings(".box").hide(1, function () {
                            s(this).removeClass("open_tab")
                        })
                    }

            })(jQuery);
        </script>

        <script>
            function setEqualHeight(columns) {
                h1 = $('#content').height();
                h2 = $('#sidebar').height();
                if (h1 > h2) {
                    $('#sidebar').height(h1 - 56);
                } else if (h1 < h2) {
                    $('#sidebar').height(h1);
                }
            }
        </script>
        <script>
            function setEqualHeightB(columns) {
                h1 = $('#content').height();
                h2 = $('').height();
                h3 = $('#sidebar').height;
                if (h1 > h2) {
                    $('#content').height(h2);
                }
                if (h1 > h3) {
                    $('#sidebar').height(h1);
                } else if (h3 > h1) {
                    $('#sidebar').height(h1);
                }
            }
        </script>
    </div>
    <div id="fade" class="black-overlay"></div>
</div>


</body>


</html>