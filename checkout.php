<?php

session_start();

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'inc/db.php';

if(!isset($_POST['amount']))
{
	die('Amount is not defined!');
}

if(!(int)$_POST['amount'] >= 1)
{
	die('Amount cant be lower than 1 ' . CURRENCY);
}

$price       = (int)$_POST['amount'];
$product     = 'Donation';
$description = 'Donating ' . $price . ' ' . CURRENCY . ' for ' . $price*2 . ' Coins.';
$quantity    = 1;

$total       = $price;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName($product)
	->setCurrency(CURRENCY)
	->setQuantity($quantity)
	->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setSubtotal($total);

$amount = new Amount();
$amount->setCurrency(CURRENCY)
	->setTotal($total)
	->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription($description)
	->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true&amount=' . $price)
	->setCancelUrl(SITE_URL . '/cancel.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions([$transaction]);

try
{
	$payment->create($paypal);
}
catch(Exception $e)
{
    die($e);
}

$approvalUrl = $payment->getApprovalLink();

header('Location: ' . $approvalUrl);

?>
