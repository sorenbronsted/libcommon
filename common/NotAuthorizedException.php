<?php
namespace sbronsted;

/**
 * Class NotAuthorizedException is a recoverable error
 * @todo move to libssoclient
 */
class NotAuthorizedException extends ApplicationException {
	public function __construct() {
		parent::__construct("Not authorized");
	}
}
