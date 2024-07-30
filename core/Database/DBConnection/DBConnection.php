<?php

namespace Core\Database\DBConnection;

use PDO;

class  DBConnection
{
    private static $dbConnectionInstance = null;
    private function __construct()
    {

    }
    public static function getDBConnectionInstance()
    {
        if(self::$dbConnectionInstance == null){   
            $DBConnection = new DBConnection();
            self::$dbConnectionInstance = $DBConnection->dbConnection();
        }
        return self::$dbConnectionInstance;
    }
    public function dbConnection()
    {
        $servername = DB_HOST;
        $dbname = DB_NAME;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;

        try {
            $con = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "connected successfuly";
            return $con;
        } catch (\PDOException $th) {
           echo $th->getMessage();
           return false;
        }
    }
}