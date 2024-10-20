<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Facebook {
	
	public function __construct() {
		
		$CI =& get_instance();
		$CI->config->load('facebook');
		
		require APPPATH .'third_party/facebook/vendor/autoload.php';
		$this->client = new \Facebook\Facebook([
		  'app_id' => $CI->config->item('app_id', 'facebook'),
		  'app_secret' => $CI->config->item('app_secret', 'facebook'),
		  'default_graph_version' => $CI->config->item('default_graph_version', 'facebook'),
		  //'default_access_token' => '{access-token}', // optional
		],false);
		$this->fb_helper = $this->client->getRedirectLoginHelper();
		 

	}
	
	public function loginURL() {
		$CI =& get_instance();
		ini_set('display_errors', 0);	
		
        return $this->fb_helper->getLoginUrl($CI->config->item('redirect_url', 'facebook'), array('email'));
		//return $this->fb_helper->getLoginUrl(site_url('facebooks/auth'), array('email','public_profile'));
    }
	
	
	
	public function getUserInfo() {
		ini_set('display_errors', 0);	
        
		try {
			if (isset($_SESSION['access_token_fb'])) {
			$accessToken = $_SESSION['access_token_fb'];
			} else {
				$accessToken = $this->fb_helper->getAccessToken()->getValue();
				$_SESSION['access_token_fb'] = $accessToken;
			}
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		 }
		 
		 
		if (!isset($accessToken)) {
		  if ($helper->getError()) {
			header('HTTP/1.0 401 Unauthorized');
			echo "Error: " . $this->fb_helper->getError() . "\n";
			echo "Error Code: " . $this->fb_helper->getErrorCode() . "\n";
			echo "Error Reason: " . $this->fb_helper->getErrorReason() . "\n";
			echo "Error Description: " . $this->fb_helper->getErrorDescription() . "\n";
		  } else {
			header('HTTP/1.0 400 Bad Request');
			echo 'Bad request';
		  }
		  exit;
		}
		 
		 
		 
		//$fb->setDefaultAccessToken($accessToken);
		 
		# These will fall back to the default access token
		$res    =   $this->client->get('/me?fields=name,email,picture',$_SESSION['access_token_fb']);
		$fbUser =   $res->getDecodedBody();
		 
		 
		/*$resImg     =   $this->client->get('/me/picture?type=large&redirect=false',$accessToken->getValue());
		$picture    =   $res->resImg(); //$resImg->getGraphObject();
		print_r($picture);
		*/ 
		$fbUser['image'] = isset($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:"";
		//$_SESSION['access_token_fb'] =  $this->fb_helper->getAccessToken()->getValue();
		session_destroy();		
		return $fbUser;
    }
	
	public function getfb()
	{
		$CI =& get_instance();
		session_start();
		ini_set('display_errors', 1);
		$fb = $this->client;
		$helper = $fb->getCanvasHelper();
		$permissions = ['email']; // optional
		try {
			if (isset($_SESSION['facebook_access_token'])) {
			$accessToken = $_SESSION['facebook_access_token'];
			} else {
				$accessToken = $helper->getAccessToken();
			}
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		 }

		if (isset($accessToken)) {
			if (isset($_SESSION['facebook_access_token'])) {
				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			} else {
				$_SESSION['facebook_access_token'] = (string) $accessToken;

				// OAuth 2.0 client handler
				$oAuth2Client = $fb->getOAuth2Client();

				// Exchanges a short-lived access token for a long-lived one
				$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

				$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			}

			// validating the access token
			try {
				$request = $fb->get('/me');
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				if ($e->getCode() == 190) {
					unset($_SESSION['facebook_access_token']);
					$helper = $fb->getRedirectLoginHelper();
					$loginUrl = $helper->getLoginUrl($CI->config->item('redirect_url', 'facebook'), $permissions);
					echo "<script>window.top.location.href='".$loginUrl."'</script>";
				}
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			// getting basic info about logged-in user
			try {
				$request = $fb->get('/me?fields=name,email');
				$profile = $request->getGraphNode()->asArray();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			echo $profile['name'];
			return;
			// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
		} else {
			$helper = $fb->getRedirectLoginHelper();
			$loginUrl = $helper->getLoginUrl($CI->config->item('redirect_url', 'facebook'), $permissions);
			redirect($loginUrl);
			return;
		}
	}
	
}
?>