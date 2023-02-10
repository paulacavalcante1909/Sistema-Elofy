<?php

require_once './Model/UserModel.php';
require_once './helpers/Response.php';
require_once './helpers/Request.php';

class UserController extends UserModel
{

    public function list()
    {
        try {
            Response::returnSuccess($this->_list());
        } catch (\Throwable $th) {
            Response::returnError($th);
        }
    }

    public function insert()
    {

        if(!Request::getPostParam('name'))
            Response::returnError('campo nome obrigatório');

        $data = [
            'name' => Request::getPostParam('name')
        ];

        $this->_insert($data);


        

    }
}
