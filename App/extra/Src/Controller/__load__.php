<?php

try {

    include 'Include/Controller.php';

} catch (\Throwable $th) {
    dieConnection($th);
}

?>