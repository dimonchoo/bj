$( document ).ready(function() {
    $('#addTask').click(function(){
        let name = $('.name').val();
        let email = $('.email').val();
        let task_text = $('.task_text').val();
        $.get("/index/addTask", {name: name, email: email, task_text: task_text})
        .done(function (data) {
            let returnedData = JSON.parse(data);
            // Очистка еретиков!!!
            $('.msg-error').text('');
            if (returnedData === true) {
                alert('Данные успешно добавлены');
            }
            if (returnedData.length !== 0) {
                Object.keys(returnedData).forEach(function(key) {
                    $('.' + key + '-error').text(returnedData[key]).css({'color':'red'});
                });
            }
        })
    });
});