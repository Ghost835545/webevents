function call(){
    var msg = $('#formx').serialize();
    $.ajax({
        type:'POST',
        url:'php/cabinet/save_user.php',
        cache:false,
        data:msg,
    // Функция сработает при успешном получении данных
    success: function(data) {
        // Отображаем данные в форме
        $('#results').html(data);
    },
    // Тип данных
    dataType:"html",
        // Функция сработает в случае ошибки
        error:  function(data){
        $('#results').html('<p>Возникла неизвестная ошибка. Пожалуйста, попробуйте чуть позже...</p>');
    }
});

}