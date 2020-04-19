<div class="container">
    <div class="row">
        <div class="col-md-5">
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
        <hr>
        <div class="col-md-10">
            <table id="example" class="display table" style="width:100%">
                <thead>
                <tr>
                    <th scope="col">Имя пользователя</th>
                    <th scope="col">E-mail</i></th>
                    <th scope="col">Текст задачи</i></th>
                    <th scope="col">Статус</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </tfoot>
            </table>
            <table class="table" style="height: 200px">
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?= htmlspecialchars($task['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($task['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($task['task_text'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($task['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="paginator">
                <?php for ($i = 1, $k = 0; $i <= $sumPage; $i++, $k++): ?>
                    <a class="btn btn-primary" href="/index?page=<?= $k ?>"><?= $i ?></a>
                <?php endfor ?>
            </div>
        </div>
    </div>
</div>
