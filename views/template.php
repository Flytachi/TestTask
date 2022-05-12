<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Document</title>
        <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../static/noty/lib/noty.css">
        <link rel="stylesheet" href="../static/css/load.css">
    </head>

    <script src="../static/js/jquery.min.js"></script>
    <script src="../static/bootstrap/js/bootstrap.min.js"></script>
    <script src="../static/noty/lib/noty.js"></script>
    <script src="../static/js/scripts.js"></script>

    <body>

        <?php include 'layout/navbar.php' ?>

        <div class="container">
            
            <div class="row mt-2">
                <?php include $content ?>
            </div>

        </div>

    </body>

    <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content" id="modalDefault-content"></div>
        </div>
    </div>

</html>