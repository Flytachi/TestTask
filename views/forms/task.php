<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"><?= ($data->value('id')) ? 'Обновить' : 'Создать' ?> задачу</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="/task/hook" method="post" onsubmit="submitForm()">

    <div class="modal-body">

        <?php $data->csrfToken(); ?>
        <input type="hidden" name="id" value="<?= $data->value('id') ?>">
        
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="name_input">Имя</label>
                    <input type="text" id="name_input" name="name" value="<?= $data->value('name') ?>" required class="form-control" placeholder="Ввдите ваше имя">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email_input">E-mail</label>
                    <input type="email" id="email_input" name="email" value="<?= $data->value('email') ?>" required class="form-control" placeholder="Ввдите e-mail">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description_input">Описание</label>
                    <textarea name="description" id="description_input" cols="30" rows="3" class="form-control" required placeholder="Описание"><?= $data->value('description') ?></textarea>
                </div>
            </div>

        </div>

    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Сохраниь</button>
    </div>

</form>

<script>

    function submitForm() {
        event.preventDefault();
        $.ajax({
            type: $(event.target).attr("method"),
            url: $(event.target).attr("action"),
            data: $(event.target).serializeArray(),
            success: function (response) {
                $('#modalDefault').modal('hide');
                if (response.status == "success") {
                    new Noty({
                        text: "Успешно!",
                        type: "success",
                    }).show();
                    credoSearch();
                } else {
                    new Noty({
                        text: response.message,
                        type: "error",
                    }).show();
                }
            },
        });
    }

</script>