<?php

session_start();

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

include('inc/db.php');

if(!isset($_GET['success']))
{
	die();
}

if((bool)$_GET['success'] === false)
{
	die();
}

$username   = $_SESSION['username'];
$order_id   = uniqid();
$price      = (int)$_GET['amount'];
$paymentId  = $_GET['paymentId'];
$token      = $_GET['token'];
$payerId    = $_GET['PayerID'];

$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try
{
	global $con;

	$result = $payment->execute($execute, $paypal);

	$data = $con->prepare('INSERT INTO transactions (order_id, username, token, payment_id, payer_id, amount, tdate)
	VALUES(:orderid, :username, :token, :paymentid, :payerid, :amount, :tdate)');
	$data->execute(array(
		':orderid'   => $order_id,
		':username'  => $username,
		':token'     => $token,
		':paymentid' => $paymentId,
		':payerid'   => $payerId,
		':amount'    => $price,
		':tdate'     => time()
	));

	$data = $con->prepare('SELECT COUNT(*) FROM coins WHERE username = :username');
	$data->execute(array(
		':username' => $username
	));

	if($data->fetchColumn() == 1)
	{
		function Coins($username)
		{
			global $con;

			$data = $con->prepare('SELECT * FROM coins WHERE username = :username');
			$data->execute(array(
				':username' => $username
			));

			foreach($data->fetchAll(PDO::FETCH_ASSOC) as $row)
			{
				return $row['coins'];
			}
		}

		$data = $con->prepare('UPDATE coins SET coins = :coins WHERE username = :username');
		$data->execute(array(
			':coins'    => Coins($username)+$price*2,
			':username' => $username
		));
	}
	else
	{
		$data = $con->prepare('INSERT INTO coins (username, coins)
		VALUES(:username, :coins)');
		$data->execute(array(
			':username' => $username,
			':coins'    => $price*2
		));
	}

	header('Location: success.php?order_id=' . $order_id);
}
catch(Exception $e)
{
	die($e->getMessage());
}

?>
