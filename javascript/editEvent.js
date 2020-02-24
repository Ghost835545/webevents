function editEvent(){
    var msg = $('#form1').serialize();
    $.ajax({
        type:'POST',
        url:'php/editEvent.php',
        cache:false,
        data:msg,
        // Функция сработает при успешном получении данных
        success: function(data) {
            // Отображаем данные в форме
            alert(data);
            window.location.href='../list_news.php'

        },
        // Тип данных
        dataType:"html",
        // Функция сработает в случае ошибки
        error:  function(data){
            alert('Возникла неизвестная ошибка. Пожалуйста, попробуйте чуть позже...');
        }
    });

}