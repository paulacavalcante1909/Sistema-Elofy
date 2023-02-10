<?php

class Response
{
    public static function returnSuccess($message = 'Ok', $data = null, $status = 200)
    {
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);

        exit;
    }


    public static function returnError($message = 'Error', $data = null, $status = 400)
    {
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);

        exit;
    }
}
