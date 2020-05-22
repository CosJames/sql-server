<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../../creaton/database.php';
    include_once '../../../creaton/functions.php';
    include_once '../../../models/user.php';
    include_once '../../../models/server.php';
    include_once '../../../services/status-map.php';

    $server = new Server();
    $user = new User();
    $func = new CreatonFunctions();

    # Check if the APIKEY is Valid
    if($server->validateAPI())
    {
        # Check if email is not null
        if(isset($_POST['email'])) {
            if($_POST['email'] !== ''
                && $_POST['password'] !== '')
            {

                # Check if email is a valid email
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                {
                    $filter = "email='".$_POST['email']."'";
            
                    $user->find($filter);
        
                    # Check if user exist
                    if($user->id !== null)
                    {
                        # Password Verifying hash
                        if($func->verifyHashPassword($_POST['password'], $user->password))
                        {
                            $arr = array(
                                'code' => '200',
                                'id'=> $user->id,
                                'username'=> $user->username,
                                'email'=> $user->email,
                            );
                            print_r(json_encode($arr));
                        }
                        else
                        {
                            # Password did not match the user password
                            print_r(STATUS_CONFLICT('Password hash did not match the requested password'));
                        }
                    }
                    else
                    {
                        # User not found
                        print_r(STATUS_NOT_FOUND('User not found'));
                    }
                }
                else
                {
                    # Email is invalid
                    print_r(STATUS_BAD_REQUEST('Requested email is not a valid email address'));
                }
            }
            else
            {
                # The request email is a empty string
                print_r(STATUS_BAD_REQUEST('Requested Variables must not be an empty string'));
            }
        }

    }
    else
    {
        # APIKEY is not registered
        echo json_encode(array(
            'code' => '403',
            'status' => 'Forbidden',
            'message' => 'SERVER RESTRICTED : You cant use this server without an APIKey'
        ));
    }