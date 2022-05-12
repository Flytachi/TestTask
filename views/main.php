
<div class="col-md-12 mb-2">
    <div class="text-right">
        <button onclick="checkModal('/task/form')" class="btn btn-success">Создать</button>
    </div>
</div>

<div class="col-md-12" id="search_display"></div>

<script type="text/javascript">

    var sort = "name";
    var type = 1;

    function Sort(sorting) {
        $(".sort_item").removeClass('text-primary');
        $(".sort_item").removeClass('text-danger');
        if (sorting == sort && type == 1) {
            $(event.target).addClass('text-danger');
            type = 0;
        } else {
            $(event.target).addClass('text-primary');
            sort = sorting;
            type = 1;
        }
        credoSearch();
    }

    function Complete(url) {
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
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
    
    function checkModal(url) {
        $.ajax({
            type: "GET",
            url: url,
            success: function (result) {
                $("#modalDefault-content").html(result);
                $("#modalDefault").modal('show');
            },
        });
    }

    function Delete(url) {
        if (confirm("Вы точно хотите удалить задачу?")) {
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
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
    }

    var cXhr = null;
    function credoSearch(params = '') {
        if (document.querySelector('#search_display')) {
            if(cXhr && cXhr.readyState != 4) cXhr.abort();
            var display = document.querySelector('#search_display');
            isLoading(display);

            cXhr = $.ajax({
                type: "GET",
                url: "task/list"+params,
                data: {
                    sort:sort,
                    type:type,
                },
                success: function (result) {
                    display.innerHTML = result;
                },
            });

        }
    }

    $(document).ready(() => credoSearch());

</script>