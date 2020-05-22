<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Creaton</title>
</head>
<body>
    <div class='ctn-container focus'>
        <h1>This is Creaton <span id="highlight">API</span></h1>
    </div>

    <div class='ctn-container focus'>
        <p>This website is used by Creaton to manage data.</p>
    </div>

    <div class='ctn-container focus column'>
        <h2 id="highlight">Analytics:</h2>
    </div>

    <div class='ctn-container focus' style="margin-bottom: 20px">
        <div class='ctn-container focus column gray' style="width: 80%">
            <h3>
                Registered Users :
                <span>
                <?php
                    include_once '../creaton/database.php';
                    include_once '../creaton/functions.php';
                    include_once '../models/user.php';
                    $user = new User();
                    $user->count();
                ?>
                </span>
                
            </h3>
        </div>
    </div>

    <div class='ctn-container focus'>
        <img src="../assets/resources/undraw_google_analytics_a57d.svg" style="width: 50%">
    </div>
</body>
</html>