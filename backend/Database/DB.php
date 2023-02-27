<?php

class DB
{

    protected function connect()
    {
        self::install();

        $database = parse_ini_file(__DIR__ . '/../env.conf', 1)['database'];
        $host = $database["host"];
        $user = $database["user"];
        $pass = $database["pass"];
        $db   = $database["base"];
        try {
            $con = new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
            return $con;
        } catch (PDOException $e) {
            echo "Erro encontrado: " . $e->getMessage();
            exit;
        }
    }



    public static function query($sql = '')
    {
        $db = self::connect();

        $query = $db->query($sql);
        $response = $query->fetchAll(PDO::FETCH_ASSOC);

        $db = null;
        $query = null;
        return $response;
    }

    private function install()
    {

        $install = parse_ini_file(__DIR__ . '/../install.conf', 1)['installed'];

        if ($install['install'] == "false") {
            $database = parse_ini_file(__DIR__ . '/../env.conf', 1)['database'];

            $host = $database["host"];
            $user = $database["user"];
            $pass = $database["pass"];


            try {
                $con = new PDO('mysql:host=' . $host . ';', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $file = file_get_contents("./database.sql");
                $con->query($file);


                file_put_contents(__DIR__ . '/../install.conf', "[installed]\ninstall='true'");
            } catch (PDOException $e) {
                echo "Erro encontrado: " . $e->getMessage();
                exit;
            }
        }
    }
}
