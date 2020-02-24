function signIn(){
    var msg = $('#formxS').serialize();
    $.ajax({
        type:'POST',
        url:'php/cabinet/signIn.php',
        cache:false,
        data:msg,
        dataType:"html",
        // Функция сработает при успешном получении данных
        success: function(data) {
            // Отображаем данные в форме
            $('#results1').html(data);

        },
        // Тип данных

        // Функция сработает в случае ошибки
        error:  function(data){
            $('#results1').html('<p>Возникла неизвестная ошибка. Пожалуйста, попробуйте чуть позже...</p>');
        }

    });
}