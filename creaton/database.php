<?php
    include 'src/mysqli_helper.php';
    include 'src/mysqli_query.php';
    include 'src/pdo_helper.php';
    include 'src/pdo_query.php';
    class CreatonMySQLi extends MySQLi_Query {}
    class CreatonPDO extends PDO_Query {}

    