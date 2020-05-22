<?php
    # API Are retrieved here
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../../creaton/database.php';
    include_once '../../../creaton/functions.php';
    include_once '../../../models/user.php';
    include_once '../../../models/server.php';
    include_once '../../../services/status-map.php';

    $server = new Server();
    $user = new User();
    
    # Check if there is a registered APIKey
    if(isset($_POST['APIKEY'])){
        # Check if the APIKEY is Valid
        if($server->validateAPI())
        { 
            if($_POST['email'] !== ''
                && $_POST['password'] !=='')
            {
                $user->username = $_POST['username'];
                $user->email = $_POST['email'];
                $user->password = $_POST['password'];
            
                # Check if email is a valid email
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                {
                    # Check if insertion is a success
                    if($user->create() !== '23000')
                    {
                        echo STATUS_OK('Insertion Success');
                    }
                    # Insertion duplicates
                    else if($user->create() === '23000')
                    {
                        echo STATUS_CONFLICT('Email is already registered!');
                    }
                    else
                    {
                        echo STATUS_BAD_REQUEST('Insertion Failed!');
                    }
                }
                else
                {
                    # Email is invalid
                    print_r(STATUS_BAD_REQUEST('Requested email is not a valid email address'));                }
                }
            else
            {
                echo STATUS_BAD_REQUEST('Requested Variable must not be an empty string');
            }
        }
        else
        {
            # Invalid APIKey Registered
            echo STATUS_BAD_REQUEST('APIKey registered is invalid');
        }
    }
    else {
        # Forbid
        echo json_encode(array(
            'code' => '403',
            'status' => 'Forbidden',
            'message' => 'SERVER RESTRICTED : You cant use this server without an APIKey'
        ));
    }
    