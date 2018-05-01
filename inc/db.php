<?php

require 'inc/settings.php';

try {
    $con = new PDO('mysql:host=' . $config['HOST'] . ';dbname=' . $config['DB'] . ';charset=UTF8', $config['USER'], $config['PASS']);
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch (PDOException $e)
{
    //die($e->getMessage());
    echo 'Error has occured, contact administrator!';
}

try {
    $con_game = new PDO('sqlsrv:Server=' . $config['HOST_GAME'] . ';Database=' . $config['DB_GAME'], $config['USER_GAME'], $config['PASS_GAME']);
    //$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch (PDOException $e)
{
    //die($e->getMessage());
    echo 'Error has occured, contact administrator!';
}

try {
    $con_clan = new PDO('sqlsrv:Server=' . $config['HOST_CLAN'] . ';Database=' . $config['DB_CLAN'], $config['USER_CLAN'], $config['PASS_CLAN']);
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch (PDOException $e)
{
    //die($e->getMessage());
    echo 'Error has occured, contact administrator!';
}

?>
