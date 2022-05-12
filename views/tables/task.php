<table class="table table-sm">
    <thead class="table-secondary">
        <tr>
            <th>№</th>
            <th class="sort_item <?php if($_GET['sort'] == 'name') echo ($_GET['type']) ? 'text-primary' : 'text-danger' ?>" onclick="Sort('name')">Пользователь</th>
            <th class="sort_item <?php if($_GET['sort'] == 'email') echo ($_GET['type']) ? 'text-primary' : 'text-danger' ?>" onclick="Sort('email')">Email</th>
            <th class="sort_item <?php if($_GET['sort'] == 'description') echo ($_GET['type']) ? 'text-primary' : 'text-danger' ?>" onclick="Sort('description')">Описание</th>
            <th class="sort_item <?php if($_GET['sort'] == 'status') echo ($_GET['type']) ? 'text-primary' : 'text-danger' ?> text-center" onclick="Sort('status')">Статус</th>
            <?php if(isset($_SESSION['id'])): ?>
                <th scope="col" class="text-right">Действия</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->list(1) as $row): ?>
            <tr>
                <th scope="row"><?= $row->count ?></th>
                <td><?= $row->name ?></td>
                <td><?= $row->email ?></td>
                <td><?= $row->description ?></td>
                <td class="text-center">
                    <?php if($row->status): ?>
                        <span class="badge badge-success">Выполнено <?php if($row->is_edit) echo ", отредактировано администратором" ?></span>
                    <?php else: ?>
                        <span class="badge badge-danger">Не выполнено</span>
                    <?php endif; ?>
                </td>
                <?php if(isset($_SESSION['id'])): ?>
                    <td class="text-right">
                        <?php if(!$row->status): ?>
                            <button onclick="Complete('/task/complete/<?= $row->id ?>')" class="btn btn-sm btn-success">complete</button>
                            <button onclick="checkModal('/task/form/<?= $row->id ?>')" class="btn btn-sm btn-primary">update</button>
                            <button onclick="Delete('/task/delete/<?= $row->id ?>')" class="btn btn-sm btn-danger">delete</button>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $data->panel() ?>