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
            INSERT INTO `users`(`name`,`email`,`senha`) VALUES ('{$data['name']}','{$data['email']}','{$data['senha']}')
        ");
    }


    protected function _delete($id)
    {
        return $this->query("
            DELETE FROM `users` WHERE id = '{$id}'
        ");
    }

    protected function _edit($data)
    {
        return $this->query("
            UPDATE `users` SET name = '{$data['name']}' WHERE id = '{$data['id']}';
        ");
    }

    protected function _login($data)
    {
        return $this->query("
            SELECT email from `users` where email = '{$data['email']}' AND senha = '{$data['senha']}'
        ");
    }
}
