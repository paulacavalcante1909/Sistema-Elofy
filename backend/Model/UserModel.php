<?php

require_once './helpers/Response.php';

require_once './Database/DB.php';

class UserModel extends DB
{

    protected function _list()
    {
        return $this->query('SELECT * FROM users');
    }

    protected function _insert($data)
    {
        return $this->query("
            INSERT INTO `users`(`name`) VALUES ('{$data['name']}')
        ");
    }


    protected function _delete($data)
    {
        return $this->query("
            DELETE FROM `users` WHERE id = '{$data}'
        ");
    }
}
