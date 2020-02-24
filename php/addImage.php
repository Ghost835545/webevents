<?php
// Пути загрузки файлов
$pathS = '../imageS/';
$tmp_pathS = '../tmpS/';
// Массив допустимых значений типа файла
$types = array('image/gif', 'image/png', 'image/jpeg');
// Максимальный размер файла
$size = 1024000;

// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Проверяем тип файла
    if (!in_array($_FILES['picture']['type'], $types))
        die('Запрещённый тип файла');


    // Проверяем размер файла
    if ($_FILES['picture']['size'] > $size)
        die('Слишком большой размер файла');

    // Функция изменения размера
    // Изменяет размер изображения в зависимости от type:
    // type = 1 - эскиз
    //  type = 2 - большое изображение
    // rotate - поворот на количество градусов (желательно использовать значение 90, 180, 270)
    // quality - качество изображения (по умолчанию 75%)
    global $pathImage;
    function resize($file, $type = 1, $rotate = null, $quality = null)
    {
        global $tmp_pathS;
        // Ограничение по ширине в пикселях
        $max_thumb_size = 200;
        $max_thumb_height = 200;
        // Качество изображения по умолчанию
        if ($quality == null)
            $quality = 75;

        // Cоздаём исходное изображение на основе исходного файла
        if ($file['type'] == 'image/jpeg')
            $source = imagecreatefromjpeg($file['tmp_name']);
        elseif ($file['type'] == 'image/png')
            $source = imagecreatefrompng($file['tmp_name']);
        elseif ($file['type'] == 'image/gif')
            $source = imagecreatefromgif($file['tmp_name']);
        else
            return false;

        // Поворачиваем изображение
        if ($rotate != null)
            $src = imagerotate($source, $rotate, 0);
        else
            $src = $source;

        // Определяем ширину и высоту изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);

        // В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
        if ($type == 1) {
            $w = $max_thumb_size;
            $h = $max_thumb_height;
        }


        if (($h_src > $h) and ($w_src > $w)){
            // Вычисление пропорций
            $ratiow = $w_src / $w;
            $ratioh = $h_src / $h;
            $w_dest = round($w_src / $ratiow);
            $h_dest = round($h_src / $ratioh);


            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);

            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

            // Вывод картинки и очистка памяти
            imagejpeg($dest, $tmp_pathS . $file['name'], $quality);
            imagedestroy($dest);
            imagedestroy($src);
            return $file['name'];
        }
        else if ($w_src > $w) {
            // Вычисление пропорций
            $ratio = $w_src / $w;
            $w_dest = round($w_src / $ratio);
            $h_dest = round($h_src / $ratio);


            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);

            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

            // Вывод картинки и очистка памяти
            imagejpeg($dest, $tmp_pathS . $file['name'], $quality);
            imagedestroy($dest);
            imagedestroy($src);
            return $file['name'];
        } else if ($h_src > $h){
        // Вычисление пропорций
    $ratio = $w_src / $h;
    $ratio = $h_src / $h;
    $w_dest = round($w_src / $ratio);
    $h_dest = round($h_src / $ratio);


    // Создаём пустую картинку
    $dest = imagecreatetruecolor($w_dest, $h_dest);

    // Копируем старое изображение в новое с изменением параметров
    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

    // Вывод картинки и очистка памяти
    imagejpeg($dest, $tmp_pathS . $file['name'], $quality);
    imagedestroy($dest);
    imagedestroy($src);
    return $file['name'];
} else
        {
            // Вывод картинки и очистка памяти
            imagejpeg($src, $tmp_pathS. $file['name'], $quality);
            imagedestroy($src);
            return $file['name'];
        }
 }
 include("addImage1.php");
 $name = resize($_FILES['picture'], 1, $_POST['file_rotate']);
 $name1 = resize1($_FILES['picture'], 2, $_POST['file_rotate']);
 //Загрузка файла и вывод сообщения
 if (!@copy($tmp_pathS . $name, $pathS . $name) &!@copy($tmp_pathB . $name1, $pathB . $name1)   )
 echo 'Что-то пошло не так';
 else
 echo 'Загрузка прошла удачно';


 $pathImage=$pathS . $_FILES['picture']['name'];
 $pathImage1=$pathB . $_FILES['picture']['name'];
 @session_start();
 if (isset($_SESSION)){
     unset($_SESSION['imageS']);
     unset($_SESSION['imageB']);

 }
 $_SESSION['imageS']=$pathImage;
 $_SESSION['imageB']=$pathImage1;
 // Удаляем временный файл
 unlink($tmp_pathS . $name);
 unlink($tmp_pathB . $name1);
}

?>