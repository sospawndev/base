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

$fromPrivateKey = '32edfbb8eecbe50154139ae5968e54272c9af9b2eb1dcb64a43d60e59f5ade00';
$toAddress = '0xa0E0F46FdF74a45c54e5D00fEba9b7541113EAc8';
$a = '000000000';
$amount = '100'.$a;
$gasLimit = '800000';
$gasPrice = '12000000000';
$txHash = $instance->write('transfer', [$toAddress, $amount], $fromPrivateKey, $gasPrice, $gasLimit);
print_r($txHash);
exit;
 

?>