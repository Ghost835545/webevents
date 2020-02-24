function loadImage(){
    var formData = new FormData();
    //не забывайти проверить поля на заполнение
    //код проверки полей опустим, он к статье не имеет отнашение
    //присоединяем наш файл
    jQuery.each($('#picture')[0].files, function(i, file) {
        formData.append('picture', file);
    });
    $.ajax({
        type:'POST',
        url:'php/addImage.php',
        data:formData,
        cache: false,
        dataType: 'json',
        processData: false, // Не обрабатываем файлы (Don't process the files)
        contentType: false,
        // Функция сработает при успешном получении данных
        success: function(data) {
            // Отображаем данные в форме
            alert(data);
        },
        // Тип данных
        dataType:"html",
        // Функция сработает в случае ошибки
        error:  function(data){
            alert('Возникла неизвестная ошибка. Пожалуйста, попробуйте чуть позже...');
        }
    });
}