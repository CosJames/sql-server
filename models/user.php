<?php

    class User
    {
        # Properties
        public $id;
        public $username;
        public $email;
        public $password;
        
        # Read Users
        function read(){
            $PDO = new CreatonPDO();

            # Fetching 
            $data = $PDO->manual_fetch(
                'Users',
                '');

            $rowCount = $data->rowCount();

            # Getting Snapshot
            if($rowCount > 0)
            {
                $arr = array();

                # Extracting Data
                while($row = $data->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    
                    $post_item = array(
                        'id' => $id,
                        'username' => $username,
                        'email' => $email,
                        'password' => $password
                    );

                    array_push($arr, $post_item);
                }


                # Displaying the data
                echo json_encode($arr);
            }


        }

        # Find Users
        function find($filter) {
            $PDO = new CreatonPDO();

            $data = $PDO->manual_fetch(
                'Users',
                'WHERE '. $filter . ';');

            $row = $data->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->password = $row['password'];
        }

        # Create User

        function create()
        {
            $PDO = new CreatonPDO();
            $func = new CreatonFunctions();

            # Columns
            $columns = array(
                'id',
                'username',
                'email',
                'password'
            );

            # Password
            $values = array(
                $func->generateId('', true),
                htmlspecialchars(strip_tags($this->username)),
                htmlspecialchars(strip_tags($this->email)),
                htmlspecialchars(strip_tags($func->hashPassword($this->password, PASSWORD_BCRYPT, array())))
            );

            return $PDO->insert(
                'Users',
                $columns,
                $values
            );

        }

         # Count Users
         function count(){
            $PDO = new CreatonPDO();

            # Fetching 
            $data = $PDO->manual_fetch(
                'Users',
                '');

            $rowCount = $data->rowCount();

            echo $rowCount;

        }
    }