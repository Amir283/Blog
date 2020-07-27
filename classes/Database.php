<?php

// a connection to the database
class Database
{
    // get the database connection. returns PDO object connection to the database server

    public function getConn()
    {
        $db_host = "";
        $db_name = "";
        $db_user = "";
        $db_pass = "";

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

        try {

            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // insert to attribute 'ATTR_ERRMODE'  the value 'ERRMODE_EXCEPTION' to get full error details. (cuz this way PDO will throw a PDOException and set its properties to show the error code and error information)

            return $db;

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
