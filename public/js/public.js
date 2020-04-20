// При пере/загрузке страницы

$( document ).ready(function() {
    table1 = $('#example1').DataTable({
        serverSide: false,
        "pageLength": 3,
        "ajax": {
            url: '/index/getTasks',
            dataSrc: '',
        },
        columns: [
            {'data': 'name', render: $.fn.dataTable.render.text()},
            {'data': 'email', render: $.fn.dataTable.render.text()},
            {'data': 'task_text', render: function (data, type, row) {
                    function escapeHtml(unsafe) {
                        if (unsafe === null) return '';
                        return unsafe
                            .replace(/&/g, "&amp;")
                            .replace(/</g, "&lt;")
                            .replace(/>/g, "&gt;")
                            .replace(/"/g, "&quot;")
                            .replace(/'/g, "&#039;");
                    }

                    let str = '';
                    if (parseInt(row['edited']) === 1) {
                        str = '<p><b>Отредактировано Администратором</p></b>';
                    }

                    if (getCookie('admin') !== undefined) {
                        return "<p data-id='"+row['id']+"' contenteditable class='editText' style='border: 1px solid" +
                            " green;'>" + escapeHtml(data) + str + "</p>";
                    }else{
                        return escapeHtml(data);
                    }
            }},
            {
                'data': 'status', render: function (data, type, row) {

                    let isCheck = '';
                    if (parseInt(data) === 1) {
                        isCheck = 'checked';
                    }
                    let status;
                    if (parseInt(data) === 0) {
                        status = 'Не выполнено';
                    } else {
                        status = 'Выполнено';
                    }
                    let str = "<input class='status' type='checkbox' " + isCheck + " data-id='" + row['id'] + "'>" +
                        "<span> " + status + " </span>";
                    return str;
                }
            }
        ]
    });

    $('#addTask').click(function () {
        let name = $('.name').val();
        let email = $('.email').val();
        let task_text = $('.task_text').val();
        $.get("/index/addTask", {name: name, email: email, task_text: task_text})
            .done(function (data) {
                let returnedData = JSON.parse(data);
                // Очистка еретиков!!!
                $('.msg-error').text('');
                console.log(data)
                if (returnedData === true) {
                    alert('Данные успешно добавлены');
                }
                if (returnedData.length !== 0) {
                    Object.keys(returnedData).forEach(function (key) {
                        $('.' + key + '-error').text(returnedData[key]).css({'color': 'red'});
                    });
                }

                // Обновляем данные
                table1.ajax.reload();
            })
    });

    $('#enter').click(function () {
        let username = $('.username').val();
        let password = $('.password').val();
        $.post("/user/checkAuth", {username: username, password: password})
            .done(function (data) {
                let returnedData = JSON.parse(data);
                if (returnedData === true) {
                    location.href = '/index';
                }
                // Очистка еретиков!!!
                $('.msg-error').text('');
                if (returnedData.length !== 0) {
                    Object.keys(returnedData).forEach(function (key) {
                        $('.' + key + '-error').text(returnedData[key]).css({'color': 'red'});
                    });
                }
            })
    });

    $(document).on('change', '.status', function () {
        let check;
        if (this.checked) {
            check = 1;
        } else {
            check = 0;
        }
        $.get("/index/updateStatus", {id: $(this).attr('data-id'), status: check})
            .done(function (data) {
                // Обновляем данные
                table1.ajax.reload();
            })

    });

    $(document).on('keydown', '.editText', function (e) {
        if (e.ctrlKey && e.keyCode == 13) {
            $.get("/index/updateText", {id: $(this).attr('data-id'), task_text: $(this).text()})
                .done(function (data) {
                    table1.ajax.reload();
                })
            console.log('saved');
        }
    });

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
});