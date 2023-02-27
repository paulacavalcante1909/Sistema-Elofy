<?php

require_once './Model/UserModel.php';
require_once './helpers/Response.php';
require_once './helpers/Request.php';

class UserController extends UserModel
{

    public function login()
    {
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];

            $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$isValid) {
                return Response::returnSuccess('Deve conter um email válido', null, 200);
            }

            if (isset($_POST['senha']) && !empty($_POST['senha'])) {
                $senha = $_POST['senha'];

                if (sizeof(str_split($senha)) < 6) {
                    return Response::returnSuccess('A senha deve conter pelo menos 6 caracteres', null, 200);
                }
            }

            $data = [
                'email' => $email,
                'senha' => $senha
            ];
            $response = $this->_login($data);

            if (isset($response[0]['email'])) {
                return Response::returnSuccess('Login realizado com sucesso!', $response, 200);
            } else {
                return Response::returnSuccess('Usuário não encontrado', $response, 200);
            }
        } else {
            return Response::returnSuccess('Os campos email e senha são obrigatórios', null, 200);
        }
    }

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
            'name' => Request::getPostParam('name'),
            'email' => Request::getPostParam('email'),
            'senha' => Request::getPostParam('senha'),

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

    public function edit()
    {
        if (!Request::getPostParam('id'))
            Response::returnError('campo id obrigatório');

        if (!Request::getPostParam('name'))
            Response::returnError('campo name obrigatório');



        $data = [
            'name' => Request::getPostParam('name'),
            'id' => Request::getPostParam('id')
        ];
        $resp = $this->_edit($data);

        return Response::returnSuccess('Dado atualizado com sucesso!', $resp, 200);
    }
}
