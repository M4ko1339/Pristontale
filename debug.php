<?php
/*
include('inc/db.php');
include('inc/functions.php');

$game = new Game();


$game->Register('testing', 'test123', 'test@gmail.com');
*/


try {
    $con = new PDO ('sqlsrv:Server=83.128.56.65;Database=accountdb', 'sa', 'Fb3MnmCy>J7k6p<z');
    echo 'Works';
} catch (PDOException $e) {
    die($e->getMessage());
}

$data = $con->prepare('SELECT * FROM TGameUser');
$data->execute();

$result = $data->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    echo $row['userid'] . ' : ' . $row['Passwd'] . '<br />';
}

?>
