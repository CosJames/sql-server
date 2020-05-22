<?php
    /**
     * This file is used to lessen querying code blocks with just a few statements.
     * Code in this class is modified to act as a query for PHP.
     * This class must be extend to the DatabaseHelper Class for it to work or else
     * You will run on some errors.
     * ----------------------------------------------------------------------------------
     * Usage :
     * Instantiate a new DatabaseQuery class then call a function you've wanted to call.
     * Example:
     * $dbQuery = new DatabaseQuery();
     * $dbQuery->fetch();
     * ----------------------------------------------------------------------------------
     * PHP version LATEST
     * Code version 0.2
     *
     * LICENSE: This source file is subject to version 3.01 of the PHP license
     * that is available through the world-wide-web at the following URI:
     * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
     * the PHP License and are unable to obtain it through the web, please
     * send a note to license@php.net so we can mail you a copy immediately.
     *
     * @author Creaton <codanielyt@gmail.com>
     */
    class PDO_Query extends PDO_Helper {

       
        #region fetch()
        /**
         * Summary
         * Use this for global use of fetch
         * 
         * @param String table - The name of the table you wanted to update the value with.
         * @param Function $successCallback - A function if the query has successfully fetched the values. 
         * Parameter consist of the row values, each time a value is fetched, this callback is called.
         * 
         * @throws Function $errorHandler - A function that is used to handle errors in the query.
         */
        public function fetch($table, $addons = '', $successCallback, $errorHandler)
        {
            $template = 'SELECT * FROM '.$table.''.$addons.';';

            $conn = parent::connect();
            # Prepared Statement
            $stmt = $conn->prepare($template);
            $stmt->execute();
            $rowCount = $stmt->rowCount();

            # Data Fetch
            if($rowCount > 0) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $successCallback($row);
                }
            }else
            {
                echo 'Nothing fetched.';
            }
        }

        # Return the $stmt variable for getting variables manually
        public function manual_fetch($table, $addons = '')
        {
            $template = 'SELECT * FROM '.$table.' '.$addons.';';

            $conn = parent::connect();
            # Prepared Statement
            $stmt = $conn->prepare($template);
            $stmt->execute();
            return $stmt;
        }
        #endregion


        public function insert($table, $columns, $values){

            # Make a SQL Sentence to be inserted as columns
            $structureColumns = "";
            foreach($columns as $data)
            {
                if($structureColumns === "")
                {
                    $structureColumns = $data;
                }
                else
                {
                    $structureColumns = $structureColumns.",".$data;
                }
            }

            # Make a SQL Sentence to be inserted as data
            $structureValues = "";
            foreach($values as $data)
            {
                if($structureValues === "")
                {
                    $structureValues = "'".$data."'";
                }
                else
                {
                    $structureValues = $structureValues.",'".$data."'";
                }
            }

            
            $template = 
                'INSERT INTO '.$table.'('.$structureColumns.') 
                VALUES ('.$structureValues.');';

            $conn = parent::connect();
            # Prepared Statement
            try{
                $stmt = $conn->prepare($template);
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e)
            {
               return $e->getCode();
            }
        }

        public function manual_insert($table, $setQuery){

            $template = 'INSERT INTO '.$table.'
            SET'. $setQuery;

            $conn = parent::connect();
            # Prepared Statement
            $stmt = $conn->prepare($template);

            
            $stmt->execute();
        }

    }