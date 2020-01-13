<?php
namespace sbronsted;

class NotAuthorizedException extends ApplicationException {
	public function __construct() {
		parent::__construct("Not authorized");
	}
}
