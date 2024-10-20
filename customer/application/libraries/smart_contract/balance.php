<?php
include __DIR__."/vendor/autoload.php";
include __DIR__."/src/EthereumSmartContract.php";

//use gri3li\EthereumSmartContract;

$instance = EthereumSmartContract::createByHost(
    'https://sepolia.base.org',
    '84532', // mainnet
    '0x163F6A145937807c93659ccF4CD35E3eb1800338', // contract address
    file_get_contents(__DIR__.'/abi.json') // abi string
);

$response = $instance->read('balanceOf', ['0xBac5407f984722A4C7E2F7911032Fc6A48753849']);
//var_dump($response);

/* array(1) {
  'balance' =>
  class phpseclib\Math\BigInteger#47 (2) {
    public $value =>
    string(24) "0x01c3ca8bcdc38115a80020"
    public $engine =>
    string(3) "gmp"
  }
} */

/** @var \BI\BigInteger $balance */
//$balance = $response['balance'];
//var_dump($balance->toString());
//print_r($response);
 
$decimals = 9;
$balance = gmp_intval($response[0]->value);
$balanceFormated = $response[0]->value / pow(10, $decimals);
 

?>