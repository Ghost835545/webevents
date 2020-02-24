<html>
<head>
    <?php
    require 'vendor/autoload.php';
    include("php/query.php");
        echo '<title>' . $_POST['title'] . '</title>';
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/pageStyle.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
include("php/query.php");
$collection = $client->webevents->events;
global $row;

$title = $collection->find(['title'=>$_POST['title'],'year'=>$_POST['year']]);


echo '<div id="content">';
foreach ($title as $row) {
    echo '<h4 id="title">' . $row['title'] . '</h4>';
    echo '<img src = ' . $row['imageB'] . ' width = "450" height = "300" align ="right" hspace = "0" vspace = "10" >';
    echo '<p id="text">' . $row['content'] . '</p>';
    echo '<p>' . date('d.m.Y', strtotime($row['dateEvent'])) . '</p>';
    echo '<p><label>Ссылка на источник:<a href=' . $row['source'] . '>' . $row['source'] . '</a></label></p>';

}
echo '</div>';
echo '<div id="footer">';
echo '</div>';
?>
</body>
</html>
