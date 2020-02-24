<?php
include 'phpQuery.php'; // Подключаем phpQuery
echo'<link rel="stylesheet" type="text/css" href="css/tabs-style.css" />';
// Теперь проверяем, не задан ли адрес новости в параметре $_GET['page']
if(!isset($_GET['page'])){
    $url = "https://mir24.tv/ohotskoe-more/simple/list/filter/all"; // Если параметр не задан, задаем URL страницы с заголовками новостей
    $curl = curl_init($url); // Инициализируем curl по указанному адресу
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Записать http ответ в переменную, а не выводить в буфер
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); // Этот параметр нужен для работы HTTPS
    curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0); // Этот параметр нужен для работы HTTPS
    $page = curl_exec($curl); // Получаем в переменную $page HTML код страницы
    $document = phpQuery::newDocument($page); // Загружаем полученную страницу в phpQuery
    $elements = $document->find('.rcn-block' ); // Находим все ссылки с классом ".blog-title a"
    echo '<ul>';
    foreach ($elements as $el) {
        $elem_pq = pq($el); // pq - аналог $ в jQuery
        $url = $elem_pq->attr('p'); // Получаем значение атрибута 'href' ссылок
        $text = trim($elem_pq->text()); // Получаем текст ссылок
        echo '<li>';
        echo('<div id="insidebar" class="'.$url.'">'.$text.'</div><br>'); // Формируем свои ссылки и выводим на наш сайт
        echo '</li>';
    };
    echo'</ul>';
} else {
    $url = $_GET['page']; // Получаем URL новости по которой кликнули из параметра $_GET['page']
    $result = strpos($url, 'https://mir24.tv/ohotskoe-more/simple/list'); // Эта проверка нужна чтобы кулхацкеры не подставляли в GET свои сайты
    if ($result === 0) {
        $curl = curl_init($url); // Инициализируем curl по указанному адресу
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Записать http ответ в переменную, а не выводить в буфер
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0); // Этот параметр нужен для работы HTTPS
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0); // Этот параметр нужен для работы HTTPS
        $page = curl_exec($curl); // Получаем в переменную $page HTML код страницы
        $document = phpQuery::newDocument($page); // Загружаем полученную страницу в phpQuery
        $elements = $document->find('.ncl-cont'); // Находим div с классом ".blog-content"
        $elem_pq = pq($elements[0]); // pq - аналог $ в jQuery
        $text = trim($elem_pq->html()); // Получаем HTML код выбранного ранее div-a
        echo('<a href="parse.php">Вернуться к списку новостей</a><br><hr><br>'); // Добавляем возврат к содержанию
        echo($text); // Выводим текст новости
    };
};
?>
