<?php

require_once './Model/UserModel.php';
require_once './helpers/Response.php';
require_once './helpers/Request.php';

class UserController extends UserModel
{

    public function list()
    {
        try {
            Response::returnSuccess(null, $this->_list(), 200);
        } catch (\Throwable $th) {
            Response::returnError("", $th);
        }
    }

    public function insert()
    {
        if (!Request::getPostParam('name'))
            return Response::returnError('campo nome obrigatório');

        $data = [
            'name' => Request::getPostParam('name')
        ];

        $resp = $this->_insert($data);

        return Response::returnSuccess('Dado Inserido com sucesso!', $resp, 200);
    }


    public function delete()
    {
        if (!Request::getPostParam('id'))
            Response::returnError('campo id obrigatório');

        $resp = $this->_delete(Request::getPostParam('id'));

        return Response::returnSuccess('Dado Deletado com sucesso!', $resp, 200);
    }
}
