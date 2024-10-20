<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include __DIR__."/smart_contract/vendor/autoload.php";
include __DIR__."/smart_contract/src/EthereumSmartContract.php";

class Smartcontract {
	public $instance;
	public $token = "";
	public function __construct() {
		
		$CI =& get_instance();
		$network = $CI->db->where('display',1)->get('network')->row_array(); 
		$this->instance = EthereumSmartContract::createByHost(
					'https://sepolia.base.org',
					'84532', // mainnet
					'0x163F6A145937807c93659ccF4CD35E3eb1800338', // contract address
					//file_get_contents(__DIR__.'/abi.json') // abi string
					$network['abi_code_token'] 
				); 

	}
	public function balance($address = "")
	{
		 $response = $this->instance->read('balanceOf', [$address]);
		 $decimals = 9;
		 $balance = gmp_intval($response[0]->value);
		 $balanceFormated = $response[0]->value / pow(10, $decimals);
		 return $balanceFormated;
	}
	public function send($address = "",$amount)
	{
		$fromPrivateKey = '32edfbb8eecbe50154139ae5968e54272c9af9b2eb1dcb64a43d60e59f5ade00';
		$toAddress = '0xa0E0F46FdF74a45c54e5D00fEba9b7541113EAc8';
		$a = '000000000';
		$amount .= $a; //= '100'.$a;
		$gasLimit = '800000';
		$gasPrice = '12000000000';
		$txHash = $this->instance->write('transfer', [$toAddress, $amount], $fromPrivateKey, $gasPrice, $gasLimit);
		return $txHash;
	}
	 
	 
	
}
?>