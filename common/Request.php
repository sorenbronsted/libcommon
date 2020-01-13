<?php
namespace sbronsted;

class Request {
	public function hasSsoToken($name) {
		return isset($_REQUEST[$name]) && !empty($_REQUEST[$name]);
	}

	public function getSsoToken($name) {
		return $this->hasSsoToken($name) ? $_REQUEST[$name] : null;
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