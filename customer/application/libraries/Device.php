<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once __DIR__.'/device-detector/vendor/autoload.php';
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
class Device {
	public $devicedetector;
	public function __construct() {
		
		

	}
	
	public function getinfo() {
		AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

		$userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
		$clientHints = ClientHints::factory($_SERVER); // client hints are optional
		
		$this->devicedetector = new DeviceDetector($userAgent, $clientHints);
		$this->devicedetector->parse();
		 
		if ($this->devicedetector->isBot()) {
		  // handle bots,spiders,crawlers,...
		  $botInfo = $this->devicedetector->getBot();
		  return array("bot"=>true,"data"=>array());
		} else {
		  $arr = array();
		  $arr['clientInfo'] = $this->devicedetector->getClient(); // holds information about browser, feed reader, media player, ...
		  $arr['os'] = $this->devicedetector->getOs();
		  $arr['device'] = $this->devicedetector->getDeviceName();
		  $arr['brand'] = $this->devicedetector->getBrandName();
		  $arr['model'] = $this->devicedetector->getModel();
		  return array("bot"=>false,"data"=>$arr);
		}
		return array("bot"=>true,"data"=>array());
		
    }
	
	 
	
}
?>