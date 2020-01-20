<?php
namespace sbronsted;

/**
 * Class MandatoryException is a recoverable error.
 */
class MandatoryException extends ApplicationException {
  public function __construct($name) {
    parent::__construct("$name skal udfyldes");
  }
}
