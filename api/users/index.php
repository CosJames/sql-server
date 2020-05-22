<?php
    header('Access-Control-Allow-Origin: *');

    include_once '../../creaton/database.php';
    include_once '../../creaton/functions.php';
    include_once '../../models/user.php';
    include_once '../../models/server.php';
    include_once '../../services/status-map.php';
    $server = new Server();

    //if(isset($_POST['APIKEY']))
    //{     
    //    if($server->validateAPI())
    //    {
    //        //$user = new User();
    //        //$user->read();
    //        echo STATUS_NOT_FOUND('Server does not allow fetch-all user function');
    //    }
    //    else
    //    {
    //        echo STATUS_BAD_REQUEST('APIKey registered is invalid');
    //    }
    //}
    //else
    //{
    //    echo json_encode(array(
    //        'code' => '403',
    //        'status' => 'Forbidden',
    //        'message' => 'SERVER RESTRICTED : You cant use this server without an APIKey'
    //    ));
    //}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>Pretzel</title>
</head>
<body>
    <div class='ctn-container focus'>
        <h1>This is Pretzel <span id="highlight">API</span></h1>
    </div>

    <div class='ctn-container focus column'>
        <p style="text-align: center">All users are stored here. Passwords are encrypted with hash, even us don't know what your password is!</p>
    </div>

    <div class='ctn-container focus'>
        <img src="../../assets/resources/undraw_secure_login_pdn4.svg" style="width: 50%">
    </div>
</body>
</html>