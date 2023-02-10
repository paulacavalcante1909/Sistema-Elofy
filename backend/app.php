<?php 

require_once "core/Loader.php";

(new Loader($_GET['endpoint']))
    ->run();

