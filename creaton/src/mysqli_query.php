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
    class MySQLi_Query extends MySQLi_Helper {
        
        # CreatonDev Tips:
        # parent:: - Act as super() accessing the inherited class
        # partner each function with ContentValues to use its potential

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
        public function fetch($table, $addons = '', $successCallback, $errorHandler) {
            # SQL Template
            $template = "SELECT * FROM ".$table." ".$addons.";";
            # SQL Query
            $query = mysqli_query(parent::connect(), $template);
            # Fetching results
            $result = mysqli_num_rows($query);
            # Data fetching
            if($result > 0) {
                # Reads per row by index
                while($row = mysqli_fetch_assoc($query))
                # A Callback is called every row is called
                $successCallback($row);
            }
            else
            {
                $errorHandler();
            }
        }
        #endregion

        #region insert()
        /**
         * Summary
         * Use this for global use of insertion
         * 
         * @param String table - The name of the table you wanted to update the value with.
         * @param Array columns - An array of columns to be used as value identifier.
         * @param Array $values - An array of values corresponding to the columns variable.
         * @param Function $successCallback - A function if the query has successfully inserted the values.
         * 
         * @throws Function $errorHandler - A function that is used to handle errors in the query.
         */
        public function insert($table, $columns, $values, $successCallback, $errorHandler){
            # Querying

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

            # check if the query has been inserted
            if(mysqli_query(parent::connect(), $template))
            {
                $id = mysqli_insert_id(parent::connect());
                $successCallback($id);
            }
            else
            {
                
                $errorHandler();
            }
            
            

            
        } 
        #endregion
        
        #region update()
        /**
         * Summary
         * Use this for global use of update.
         * 
         * @param String $table - The name of the table you wanted to update the value with.
         * @param Array $columnsToChange - An array of columns to be updated.
         * @param Array $values - An array of values corresponding to the columnsToChange variable.
         * @param String $filterQuery - A stringed-query use to find a specific column with a specific variable.
         * Example: [column]='value';
         * @param Function $successCallback - A function if the query has successfully updated the values.
         * 
         * @throws Function $errorHandler - A function that is used to handle errors in the query.
         */
        public function update($table, $columnsToChange, $values, $filterQuery, $successCallback, $errorHandler)
        {
            # Creating a sentence structure for update.
            $structure = '';
            for($i = 0; $i < count($columnsToChange); $i++)
            {
                if($structure === '')
                {
                    $structure = $structure."".$columnsToChange[$i]."='".$values[$i]."' ";
                }
                else
                {
                    $structure = $structure.", ".$columnsToChange[$i]."='".$values[$i]."' ";
                }
            }
            # Querying
            $template = 
                "UPDATE ".$table.
                " SET ".$structure.
                " WHERE ".$filterQuery.
                ";";
            if(mysqli_query(parent::connect(), $template))
            {
                $successCallback();
            }
            else
            {
                $errorHandler();
            }
        }
        #endregion

        #region delete() 
        /**
         * Summary
         * Use this for global use of delete.
         * 
         * @param String $table - The name of the table you wanted to update the value with.
         * @param String $filterQuery - A stringed-query use to find a specific column with a specific variable.
         * Example: [column]='value';
         * @param Function $successCallback - A function if the query has successfully updated the values.
         * 
         * @throws Function $errorHandler - A function that is used to handle errors in the query.
         */
        public function delete($table, $filterQuery, $successCallback, $errorHandler)
        {
            # Querying
            $template = 
                " DELETE FROM ".$table.
                " WHERE ".$filterQuery.";";
            if(mysqli_query(parent::connect(), $template))
            {
                $successCallback();
            }
            else
            {
                $errorHandler();
            }
        }
        #endregion
    }