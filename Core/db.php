<?php
class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance($localhost = NULL, $dbname = NULL, $username = NULL, $password = NULL) {

        if (!isset(self::$instance)) {

            $localhost = $localhost? $localhost:__HOSTNAME__;
            $dbname = $dbname? $dbname:__DATABASE__;
            $username = $username? $username:__USERNAME__;
            $password = $password? $password:__PASSWORD__;

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            try{
                self::$instance = new pdo( 'mysql:host='.$localhost.';dbname='.$dbname.';charset=utf8',
                    $username,
                    $password,
                    $pdo_options);
            }
            catch(PDOException $ex){
                die(json_encode(array('exito' => false, 'mensaje' => 'No se pudo conectar a la BD', 'code'=> $ex->getMessage())));
            }
        }
        return self::$instance;
    }
}
