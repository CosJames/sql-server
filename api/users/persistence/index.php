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
        if(isset($_POST['id'])) {
            if($_POST['id'] !== '') {
                $filter = "id='".$_POST['id']."'";
            
                $user->find($filter);
        
                # Check if user exist
                if($user->id !== null)
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
                    # User not found
                    print_r(STATUS_NOT_FOUND('User not found'));
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