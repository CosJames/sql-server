<?php
    /**
     * This file is used to run your PHP database, this file is always required by
     * the databaseQuery in order to function. Fill out this class constructor,
     * with your server information. See region __construct()...
     *
     * PHP version LATEST
     * Code version 0.1
     *
     * LICENSE: This source file is subject to version 3.01 of the PHP license
     * that is available through the world-wide-web at the following URI:
     * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
     * the PHP License and are unable to obtain it through the web, please
     * send a note to license@php.net so we can mail you a copy immediately.
     *
     * @author Creaton <codanielyt@gmail.com>
     */
    class PDO_Helper {
        private $serverName;
        private $userName;
        private $password;
        private $dbName;
        private $conn;

        public function __construct()
        {
            include dirname(dirname(__FILE__)).'/configure/init.php';
            $this->serverName = $serverName;
            $this->userName = $userName;
            $this->password = $password;
            $this->dbName = $dbName;
        }

        public function connect()
        {
            $this->conn = null;

            try{
                $this->conn = new PDO(
                    'mysql:host='. $this->serverName .
                    ';dbname='. $this->dbName,
                    $this->userName,
                    $this->password
                );
                $this->conn->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            }
            catch(PDOException $e)
            {
                echo ('Connection Error: '. $e->getMessage());
            }
        

            return $this->conn;
        }
    }