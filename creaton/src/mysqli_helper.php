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

    class MySQLi_Helper {

        #region __construct()
        /**
         * Summary
         * This is where you will put the info of your database.
         * Fill each data with the value required and it will be connected
         * using the connect() function and this class is used by the databaseQuery class
         * to function.
         */
        public function __construct()
        {
            include getcwd().'/creaton/configure/init.php';
            $this->serverName = $serverName;
            $this->userName = $userName;
            $this->password = $password;
            $this->dbName = $dbName;
        }
        #endregion
        
        #region connect()
        /**
         * Summary
         * Use this function to connect to your database. Fill out the variables.
         * 
         * @return Connection $conn - returns a conn value used for querying.
         */
        public function connect()
        {
            $conn = mysqli_connect(
                $this->serverName, 
                $this->userName, 
                $this->password, 
                $this->dbName);  
            return $conn;
        }
        #endregion
    }