<?php

$this->addRoutes([
    'user/list' => ['UserController', 'list'],
    'user/add' => ['UserController', 'insert'],
    'user/delete' => ['UserController', 'delete'],
    'user/edit' => ['UserController', 'edit'],
    'user/login' => ['UserController', 'login']
]);
