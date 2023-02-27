<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Credentials: true");

header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");

header("Access-Control-Allow-Headers: *");

require_once "core/Loader.php";


(new Loader($_GET['endpoint']))
    ->run();
