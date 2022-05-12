<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="/auth/verification" method="post" onsubmit="submitForm()">

    <div class="modal-body">
        
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="login_input">Логин</label>
                    <input type="text" id="login_input" name="username" class="form-control" required placeholder="Ввдите логин">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password_input">Пароль</label>
                    <input type="password" id="password_input" name="password" class="form-control" required placeholder="Ввдите пароль">
                </div>
            </div>

        </div>

    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Войти</button>
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
                    location.reload();
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