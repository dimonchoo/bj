<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4>Создание новой задачи</h4>
            <div>
                <input type="text" class="form-control name" placeholder="Имя">
                <span class="msg-error name-error"></span>
                <input type="text" class="form-control email" placeholder="E-mail">
                <span class="msg-error email-error"></span>
                <textarea class="form-control task_text" cols="30" rows="3" placeholder="Текст задачи"></textarea>
                <span class="msg-error task_text-error"></span>
            </div>
            <div class="btn btn-success" id="addTask">Добавить</div>
        </div>
        <div class="col-md-6">
            <div class="btn btn-primary float-right">
                <?php if (array_key_exists('admin', $_COOKIE)): ?>
                    <a href="/user/exit" style="color: #fff;">Выйти</a>
                <?php else: ?>
                    <a href="/user/auth" style="color: #fff;">Авторизация</a>
                <?php endif;?>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <table id="example1" class="display table" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">Имя пользователя</th>
                    <th scope="col">E-mail</i></th>
                    <th scope="col">Текст задачи</i></th>
                    <th scope="col">Статус</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
