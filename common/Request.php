<?php
namespace ufds;

class Request {
  public function hasSsoToken() {
    return isset($_REQUEST['jwt']) && !empty($_REQUEST['jwt']);
  }
  
  public function getSsoToken() {
    return $this->hasSsoToken() ? $_REQUEST['jwt'] : null;
  }
  
  public function hasCookie($cookieName) {
    return isset($_COOKIE[$cookieName]) && !empty($_COOKIE[$cookieName]);
  }
  
  public function setCookie($cookieName, $value, $ttl) {
    setcookie($cookieName, $value, $ttl); // this does not set $_COOKIE, but only the header
		$_COOKIE[$cookieName] = $value;
	}
  
  public function getCookie($cookieName) {
    return $_COOKIE[$cookieName];
  }
}